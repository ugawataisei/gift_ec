<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(ProductUpdateRequest $request): RedirectResponse
    {
        try {
            DB::transaction(function () use ($request) {
                //商品テーブルへのデータ保存
                $query = Product::query();
                $query->where('id', $request->get('id'));
                $model = $query->first();

                if ($model === null) {
                    return false;
                }

                $model->update([
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

                //在庫テーブルへのデータ保存
                $query = Stock::query();
                $query->where('product_id', $request->get('id'));
                $model = $query->first();

                if ($model === null) {
                    return false;
                }

                //在庫情報が変更されていた場合リダイレクトさせる
                if ($model->quantity !== (int)$request->get('quantity')) {
                    return redirect("owner/product/edit/{$request->get('id')}")
                        ->with([
                            'status' => 'alert',
                            'message' => '在庫情報が既に変更されています。変更をご確認ください',
                        ]);
                }

                //操作が出庫の場合 -を付与する
                if ($request->get('type') === 0) {
                    $quantity = $request->get('quantity') * -1;
                } else {
                    $quantity = $request->get('quantity');
                }

                $model->update([
                    'type' => $request->get('type'),
                    'quantity' => $quantity,
                ]);

                return true;
            });

        } catch (\Throwable $error) {
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


