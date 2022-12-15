<?php

namespace App\Services;

use App\Http\Requests\Owner\Shop\ShopUpdateRequest;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopService
{
    /**
     * @param ShopUpdateRequest $request
     * @param Shop $model
     * @return void
     */
    public function updateShopByRequest(ShopUpdateRequest $request, Shop $model): void
    {
        DB::transaction(function () use ($request, $model) {
            if (!$request->has('image')) { //画像更新なし
                $model->fill([
                    'name' => $request->get('name'),
                    'information' => $request->get('information'),
                    'is_selling' => $request->get('is_selling'),
                ]);
            } else { //画像更新あり
                $resizedImage = InterventionImage::make($request->file()['image'])
                    ->resize(1920, 1080)
                    ->encode();
                $fileName = uniqid(rand() . '_');
                $extension = $request->file()['image']->extension();
                $fileNameToStore = $fileName . '.' . $extension;

                Storage::put('public/images/shops/' . $fileNameToStore, $resizedImage);

                $model->fill([
                    'name' => $request->get('name'),
                    'information' => $request->get('information'),
                    'file_name' => $fileNameToStore,
                    'is_selling' => $request->get('is_selling'),
                ]);
                $model->save();
            }
        });
    }
}
