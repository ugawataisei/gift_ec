<?php

namespace App\Services;

use App\Consts\CommonConst;
use App\Consts\StockConst;
use App\Http\Requests\User\Cart\CartStoreRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use App\Jobs\SendSuccessMailJob;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class CartService
{
    /**
     * 顧客のカート情報を返却
     *
     * @return Collection|Cart
     */
    public function returnAllProductInCart(): Collection|Cart
    {
        return Cart::query()
            ->where('user_id', Auth::id())
            ->get();
    }

    /**
     * 送信されたリクエストデータからCart保存処理
     *
     * @param CartStoreRequest $request
     * @return void
     */
    public function storeCartByRequest(CartStoreRequest $request): void
    {
        /** @var Cart $model */
        $model = Cart::query()
            ->where('user_id', Auth::id())
            ->where('product_id', $request->get('product_id'))
            ->first();

        if ($model === null) {
            Cart::query()
                ->create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->get('product_id'),
                    'quantity' => $request->get('quantity'),
                ]);
        } else { //既にカートに商品が存在する場合
            $model->fill([
                'quantity' => $request->get('quantity'),
            ]);
            $model->save();
        }
    }

    /**
     * カート内の商品決済処理
     *
     * @return array
     */
    public function checkoutInCartItems(): array
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $publicKey = env('STRIPE_PUBLIC_KEY');

        /** @var User $user */
        $user = User::query()
            ->where('id', Auth::id())
            ->first();

        try {
            return DB::transaction(function () use ($user, $publicKey) {
                /** @var Product|Collection $products */
                /** @var Product $product */
                $products = $user->products;
                $line_items = [];
                foreach ($products as $product) {
                    $query = Stock::query();
                    $stockQuantity = $query->where('product_id', $product->id)
                        ->sum('quantity');

                    if ($product->pivot->quantity <= $stockQuantity) { //購入品が在庫数を下回っていたら
                        $line_item = [
                            'price_data' => [
                                'currency' => 'jpy',
                                'unit_amount' => $product->price,
                                'product_data' => [
                                    'name' => $product->name,
                                    'description' => $product->information,
                                ],
                            ],
                            'quantity' => $product->pivot->quantity,
                        ];
                        $line_items[] = $line_item;

                        $query->create([ //決済前在庫情報更新
                            'product_id' => $product->id,
                            'type' => StockConst::STOCK_ADD,
                            'quantity' => $product->pivot->quantity,
                        ]);

                    } else {
                        return redirect()->route('user.cart.index')
                            ->with([
                                'status' => CommonConst::REDIRECT_STATUS_ALERT,
                                'message' => __('cart.error_message.stock_shortage'),
                            ]);
                    }
                }

                $session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [$line_items],
                    'mode' => 'payment',
                    'success_url' => route('user.cart.success'),
                    'cancel_url' => route('user.cart.cancel'),
                ]);

                return [
                    'publicKey' => $publicKey,
                    'session' => $session,
                ];
            });
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }


    /**
     * 決済処理成功時
     *
     * @return void
     */
    public function successCheckout(): void
    {
        $models = Cart::query()->where('user_id', Auth::id())->get();
        $cartInfo = [];
        foreach ($models as $key => $model) {
            /** @var Cart $model */
            $cartInfo[$key]['user_email'] = $model->user->email;
            $cartInfo[$key]['owner_email'] = $model->product->shop->owner->email;
            $cartInfo[$key]['product_id'] = $model->product->id;
            $cartInfo[$key]['product_name'] = $model->product->name;
            $cartInfo[$key]['product_price'] = $model->product->price;
            $cartInfo[$key]['product_quantity'] = $model->quantity;
        }

        SendSuccessMailJob::dispatch($cartInfo);

        Cart::query()->where('user_id', Auth::id())->delete();
    }

    /**
     * 決済処理キャンセル時
     *
     * @return void
     */
    public function cancelCheckout(): void
    {
        /** @var User $user */
        $user = User::query()
            ->where('id', Auth::id())
            ->first();

        /** @var Product|Collection $products */
        $products = $user->products;
        foreach ($products as $product) {

            /** @var Product $product */
            Stock::query()->create([ //在庫情報戻す
                'product_id' => $product->id,
                'type' => StockConst::STOCK_REDUCE,
                'quantity' => $product->pivot->quantity * -1,
            ]);
        }
    }
}
