<?php

namespace App\Http\Actions\User\Cart;

use App\Consts\CommonConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Cart\CartStoreRequest;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;

class CartStoreAction extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->middleware('auth:users');
        $this->cartService = $cartService;
    }

    /**
     *
     * @param CartStoreRequest $request
     * @return RedirectResponse
     */
    public function __invoke(CartStoreRequest $request): RedirectResponse
    {
        $this->cartService->storeCartByRequest($request);

        return redirect()
            ->route('user.item.show', ['id' => $request->get('product_id')])
            ->with([
                'status' => CommonConst::REDIRECT_STATUS_INFO,
                'message' => __('cart.success_message.store'),
            ]);
    }
}



