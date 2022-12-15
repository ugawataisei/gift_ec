<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductDestroyAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var Product $model */
        $query = Product::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();

        if ($model === null) {
            return response()->json([
                'error' => true,
                'message' => __('product.error_message.destroy'),
            ]);
        }
        $model->delete();

        return response()->json([
            'success' => true,
            'message' => __('product.success_message.destroy'),
            'data' => [
                'id' => $request->get('id'),
            ]
        ]);
    }
}
