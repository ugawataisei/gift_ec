<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Product\ProductStoreRequest;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductStoreAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(ProductStoreRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $query = Product::query();
                /** @var Product $model */
                $model = $query->create([
                    'shop_id' => $request->get('shop_id'),
                    'secondary_category_id' => $request->get('secondary_category_id'),
                    'image_first' => $request->get('image_first'),
                    'image_second' => $request->get('image_second'),
                    'image_third' => $request->get('image_third'),
                    'image_fourth' => $request->get('image_fourth'),
                    'name' => $request->get('name'),
                    'information' => $request->get('information'),
                    'price' => $request->get('price'),
                    'is_selling' => $request->get('is_selling'),
                    'sort_order' => $request->get('sort_order') ?? 1,
                ]);

                $query = Stock::query();
                $query->create([
                    'product_id' => $model->id,
                    'type' => $request->get('type'),
                    'quantity' => (int)$request->get('quantity'),
                ]);
            });
        } catch (Throwable $error) {
            Log::error($error);
            throw $error;
        }

        return redirect('owner/product/index')->with([
            'status' => 'info',
            'message' => '商品登録が完了しました',
        ]);
    }
}



