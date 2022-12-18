<?php

namespace App\Services;

use App\Consts\ProductConst;
use App\Models\PrimaryCategory;
use App\Models\Product;
use App\Models\SecondaryCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemService
{
    /**
     * 販売中の商品情報返却
     *
     * @param Request $request
     * @return Product|Collection
     */
    public function returnSellingItem(Request $request): Product|Collection
    {
        $query = Product::query();
        $query->where('is_selling', 1)
            ->sortOrder((int)$request->get('order_id'), $request)
            ->selectCategory((int)$request->get('category_id'), $request);
        return $query->get();
    }

    public function returnSearchCategoryList(): array
    {
        /** @var Collection $models */
        $query = PrimaryCategory::query();
        $models = $query->get();

        $selectCategoryList = [];
        foreach ($models as $model) { //メインカテゴリー
            /** @var PrimaryCategory $model */
            foreach ($model->secondary_categories as $secondary_category) { //第二カテゴリー
                /** @var SecondaryCategory $secondary_category */
                $selectCategoryList[$model->name][$secondary_category->id] = $secondary_category->name;
            }
        }

        return $selectCategoryList;
    }

    public function returnItemShowViewParams(int $id): array
    {
        /** @var Product $model */
        $query = Product::query();
        $model = $query->find($id);

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        $productQuantity = $model->getQuantity();
        if ($productQuantity > ProductConst::SELECT_QUANTITY_ITEM_MAX) {
            $productQuantity = ProductConst::SELECT_QUANTITY_ITEM_MAX;
        }

        return [
            'model' => $model,
            'quantity' => $productQuantity,
            'shop' => $model->shop
        ];
    }
}
