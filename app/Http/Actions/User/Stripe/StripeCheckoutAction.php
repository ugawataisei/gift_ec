<?php

namespace App\Http\Actions\User\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use App\Consts\StockConst;
use App\Consts\CommonConst;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeCheckoutAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     *
     * @param Request $request
     * @return View|RedirectResponse
     * @throw \Stripe\Exception\ApiErrorException
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $publicKey = env('STRIPE_PUBLIC_KEY');

        /** @var User $user */
        $user = User::query()
            ->where('id', Auth::id())
            ->first();

        try {
            $session = DB::transaction(function () use ($user) {
                /** @var Product|Collection $products */
                /** @var Product $product */
                $products = $user->products;
                $line_items = [];
                foreach ($products as $product) {

                    $query = Stock::query();
                    $stockQuantity = $query->where('product_id', $product->id)
                        ->sum('quantity');

                    if ($product->pivot->quantity <= $stockQuantity) {
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
                                'message' => __('cart.error_message.stock_error'),
                            ]);
                    }
                }

                return Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [$line_items],
                    'mode' => 'payment',
                    'success_url' => route('user.stripe.success'),
                    'cancel_url' => route('user.stripe.cancel'),
                ]);
            });
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }

        $viewParams = [
            'publicKey' => $publicKey,
            'session' => $session,
        ];

        return view('user.stripe.checkout', $viewParams);
    }
}



