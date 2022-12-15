<?php

namespace App\Services;

use App\Consts\StockConst;
use App\Http\Requests\Owner\Product\ProductStoreRequest;
use App\Http\Requests\Owner\Product\ProductUpdateRequest;
use App\Models\Image;
use App\Models\Owner;
use App\Models\Product;
use App\Models\SecondaryCategory;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ProductService
{
    /**
     * owner.product.createに渡すパラメータ返却
     *
     * @return array
     */
    public function returnProductCreateViewParams(): array
    {
        /** @var array $selectCategoryList */
        $query = SecondaryCategory::query();
        $query->select('id', 'name');
        $selectCategoryList = $query->get()
            ->pluck('name', 'id')
            ->toArray();

        /** @var Collection $images */
        $query = Image::query();
        $query->where('owner_id', Auth::id());
        $images = $query->get();

        /** @var Owner $model */
        $query = Owner::query();
        $model = $query->where('id', Auth::id())
            ->first();
        $shopId = $model->shop->id;

        return [
            $selectCategoryList,
            $images,
            $shopId,
        ];
    }


    /**
     * owner.product.editに渡すパラメータ返却
     *
     * @param int $id
     * @return array
     */
    public function returnProductEditeViewParams(int $id): array
    {
        /** @var Product $model */
        $query = Product::query();
        $query->where('id', $id);
        $model = $query->first();

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        /** @var array $selectCategoryList */
        $query = SecondaryCategory::query();
        $query->select('id', 'name');
        $selectCategoryList = $query->get()
            ->pluck('name', 'id')
            ->toArray();

        /** @var integer $currentQuantity */
        $query = Stock::query();
        $query->where('product_id', $id);
        $currentQuantity = (int)$query->sum('quantity');

        /** @var Collection $images */
        $query = Image::query();
        $query->where('owner_id', Auth::id());
        $images = $query->get();

        return [
            $model,
            $selectCategoryList,
            $currentQuantity,
            $images
        ];
    }

    /**
     * 受け取ったリクエストデータからProduct保存
     *
     * @param ProductStoreRequest $request
     * @return void
     * @throws Throwable
     *
     */
    public function storeProduct(ProductStoreRequest $request): void
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

                $query = Stock::query(); //初期仕入数
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
    }

    /**
     * 受け取ったリクエストデータからProduct更新
     *
     * @param ProductUpdateRequest $request
     * @return Product|array
     * @throws Throwable
     */
    public function updateProduct(ProductUpdateRequest $request): Product|array
    {
        try {
            DB::transaction(function () use ($request) {
                /** @var Product $model */
                $query = Product::query();
                $query->where('id', $request->get('id'));
                $model = $query->first();

                if ($model === null) {
                    throw new NotFoundHttpException();
                }

                $model->fill([
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
                $model->save();

                /** @var Stock $model */
                $query = Stock::query();
                $query->where('product_id', $request->get('id'));

                $quantity = (int)$query->sum('quantity');
                if ($quantity !== (int)$request->get('quantity')) {
                    throw new \Exception(__('product.success_message.stock'));
                }

                if ($request->get('type') !== null) {
                    $request->get('type') === StockConst::STOCK_REDUCE ? $quantity = $request->get('quantity') * -1 : $quantity = $request->get('quantity');
                    $query = Stock::query();
                    $query->create([
                        'product_id' => $request->get('id'),
                        'type' => $request->get('type'),
                        'quantity' => $quantity,
                    ]);
                }
                return $model;
            });
        } catch (Throwable $error) {
            Log::error($error);
            throw $error;
        }
        return [];
    }
}
