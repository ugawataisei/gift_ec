<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Consts\StockConst;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param ProductUpdateRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(ProductUpdateRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                /** @var Product $model */
                $query = Product::query();
                $query->where('id', $request->get('id'));
                $model = $query->first();
                if ($model === null) {
                    return false;
                }
                $model->fill([
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
                $model->save();

                /** @var Stock $model */
                $query = Stock::query();
                $query->where('product_id', $request->get('id'));

                $quantity = (int)$query->sum('quantity');
                if ($quantity !== (int)$request->get('quantity')) {
                    return redirect("owner/product/edit/{$request->get('id')}")
                        ->with([
                            'status' => 'alert',
                            'message' => '在庫情報が既に変更されています。変更をご確認ください',
                        ]);
                }
                if (!is_null($request->get('type'))) {
                    $request->get('type') === StockConst::STOCK_REDUCE ?
                        $quantity = $request->get('quantity') * -1:
                        $quantity = $request->get('quantity');
                    $query = Stock::query();
                    $query->create([
                        'product_id' => $request->get('id'),
                        'type' => $request->get('type'),
                        'quantity' => $quantity,
                    ]);
                }
                return true;
            });
        } catch (Throwable $error) {
            Log::error($error);
            throw $error;
        }

        return redirect("owner/product/edit/{$request->get('id')}")
            ->with([
                'status' => 'info',
                'message' => '商品情報を更新しました',
            ]);
    }
}


