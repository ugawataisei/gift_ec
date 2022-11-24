<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ImageUpdateRequest;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ProductUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(ImageUpdateRequest $request)
    {
        $query = Image::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();

        if ($model === null) {
            return redirect('owner/image/edit/' . $request->get('id'))
                ->with([
                    'status' => 'alert',
                    'message' => '更新対象の画像情報が存在しませんでした',
                ]);
        }

        $deleteFileName = $model->file_name;
        DB::transaction(function () use ($request, $model, $deleteFileName) {

            //画像のリサイズ
            $resizedImage = InterventionImage::make($request->file()['file'])
                ->resize(1920, 1080)
                ->encode();

            $fileName = uniqid(rand() . '_');
            $extension = $request->file()['file']->extension();
            $fileNameToStore = $fileName . '.' . $extension;

            Storage::put('public/images/products/' . $fileNameToStore, $resizedImage);
            Storage::delete('public/images/products/' . $deleteFileName);

            //データベース更新
            $model->update(
                [
                    'owner_id' => $request->get('owner_id'),
                    'title' => $request->get('title'),
                    'file_name' => $fileNameToStore,
                    'is_selling' => $request->get('is_selling'),
                ]
            );
        });

        return redirect('owner/image/edit/' . $request->get('id'))
            ->with([
                'status' => 'info',
                'message' => '画像情報を更新しました',
            ]);
    }
}


