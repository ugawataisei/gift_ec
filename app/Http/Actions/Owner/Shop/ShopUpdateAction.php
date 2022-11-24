<?php

namespace App\Http\Actions\Owner\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\ShopUpdateRequest;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ShopUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(ShopUpdateRequest $request)
    {
        $query = Shop::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();

        if ($model === null) {
            return redirect('owner/shop/edit/' . $request->get('id'))
                ->with([
                    'status' => 'alert',
                    'message' => '更新対象の店舗情報が存在しませんでした',
                ]);
        }

        DB::transaction(function () use ($request, $model) {

            if ($request->has('image')) {
                //画像のリサイズ
                $resizedImage = InterventionImage::make($request->file()['image'])
                    ->resize(1920, 1080)
                    ->encode();

                $fileName = uniqid(rand() . '_');
                $extension = $request->file()['image']->extension();
                $fileNameToStore = $fileName . '.' . $extension;

                Storage::put('public/images/shops/' . $fileNameToStore, $resizedImage);

                //データベース更新
                $model->update(
                    [
                        'name' => $request->get('name'),
                        'information' => $request->get('information'),
                        'file_name' => $fileNameToStore,
                        'is_selling' => $request->get('is_selling'),
                    ]
                );
            }

            $model->update(
                [
                    'name' => $request->get('name'),
                    'information' => $request->get('information'),
                    'is_selling' => $request->get('is_selling'),
                ]
            );
        });

        return redirect('owner/shop/edit/' . $request->get('id'))
            ->with([
                'status' => 'info',
                'message' => '店舗情報を更新しました',
            ]);
    }
}
