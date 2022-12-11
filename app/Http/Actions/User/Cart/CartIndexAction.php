<?php

namespace App\Http\Actions\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        /** @var Collection $models */
        $models = Cart::query()
            ->where('user_id', Auth::id())
            ->get();

        return view('user.cart.index', compact('models'));
    }
}



