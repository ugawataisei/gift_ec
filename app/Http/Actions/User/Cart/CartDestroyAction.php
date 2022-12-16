<?php

namespace App\Http\Actions\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartDestroyAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var Cart $model */
        $model = Cart::query()
            ->where('id', $request->get('id'))
            ->first();

        if ($model === null) {
            return response()->json([
                'error' => true,
                'message' => __('cart.error_message.destroy'),
            ]);
        }
        $model->delete();

        return response()->json([
            'success' => true,
            'message' => __('cart.success_message.destroy'),
            'data' => [
                'id' => $request->get('id'),
            ]
        ]);
    }
}



