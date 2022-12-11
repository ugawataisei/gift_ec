<?php

namespace App\Http\Actions\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartStoreAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
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
        } else {
            $model->fill([
                'quantity' => $request->get('quantity'),
            ]);
            $model->save();
        }

        return redirect()
            ->route('user.item.show', ['id' => $request->get('product_id')])
            ->with([
                'status' => 'info',
                'message' => '商品をカートに入れました。',
            ]);
    }
}



