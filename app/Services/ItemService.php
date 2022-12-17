<?php

namespace App\Services;

use App\Consts\ProductConst;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemService
{
    /**
     * 販売中の商品情報返却
     *
     * @return Product|Collection
     */
    public function returnSellingItem(): Product|Collection
    {
        $query = Product::query();
        $query->where('is_selling', 1);
        return $query->get();
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
