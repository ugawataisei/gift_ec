<?php

namespace App\Http\Actions\User\Stripe;

use App\Consts\CommonConst;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class StripeSuccessAction extends Controller
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
        //カート情報削除
        Cart::query()->where('user_id', Auth::id())->delete();

        return redirect()->route('user.item.index')->with([
            'status' => CommonConst::REDIRECT_STATUS_INFO,
            'message' => __('cart.success_message.stripe_success'),
        ]);
    }
}
