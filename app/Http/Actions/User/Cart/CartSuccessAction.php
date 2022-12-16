<?php

namespace App\Http\Actions\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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
     * @return View
     */
    public function __invoke(Request $request): View
    {
        /** @var Collection|Cart $models */
        $models = $this->cartService->returnAllProductInCart();

        return view('user.cart.index', compact('models'));
    }
}




