<?php

namespace App\Services;

use App\Http\Requests\User\Cart\CartStoreRequest;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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
}
