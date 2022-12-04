<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Image\ImageUpdateRequest;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param ImageUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(ImageUpdateRequest $request): RedirectResponse
    {
        /** @var Image $model */
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

        DB::transaction(function () use ($request, $model, $deleteFileName) {
            $resizedImage = InterventionImage::make($request->file()['file'])
                ->resize(1920, 1080)
                ->encode();
            $fileName = uniqid(rand() . '_');
            $extension = $request->file()['file']->extension();
            $fileNameToStore = $fileName . '.' . $extension;

            Storage::put('public/images/products/' . $fileNameToStore, $resizedImage);
            if (Storage::exists('public/images/products/' . $model->file_name)){
                Storage::delete('public/images/products/' . $model->file_name);
            }
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


