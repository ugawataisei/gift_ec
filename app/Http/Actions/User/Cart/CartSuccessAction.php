<?php

namespace App\Http\Actions\User\Cart;

use App\Consts\CommonConst;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartSuccessAction extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->middleware('auth:users');
        $this->cartService = $cartService;
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $this->cartService->successCheckout();

        return redirect()->route('user.item.index')->with([
            'status' => CommonConst::REDIRECT_STATUS_INFO,
            'message' => __('cart.success_message.checkout'),
        ]);
    }
}




