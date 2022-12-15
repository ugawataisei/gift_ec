<?php

namespace App\Http\Actions\User\Stripe;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use App\Consts\StockConst;
use App\Consts\CommonConst;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class StripeCancelAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     *
     * @return RedirectResponse
     */
    public function __invoke(): RedirectResponse
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

        return redirect()->route('user.item.index')->with([
            'status' => CommonConst::REDIRECT_STATUS_INFO,
            'message' => __('cart.error_message.stripe_cancel'),
        ]);
    }
}
