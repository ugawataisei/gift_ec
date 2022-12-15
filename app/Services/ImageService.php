<?php

namespace App\Services;

use App\Consts\ImageConst;
use App\Http\Requests\Owner\Image\ImageStoreRequest;
use App\Http\Requests\Owner\Image\ImageUpdateRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ImageService
{
    /**
     * 1920×1080にリサイズして画像を保存
     *
     * @param ImageStoreRequest $request
     * @param string $path
     * @return void
     * @throws Throwable
     */
    public function storeImageInStorage(ImageStoreRequest $request, string $path): void
    {
        if ($request->file()['files']) {
            try {
                DB::transaction(function () use ($request, $path) {
                    foreach ($request->file()['files'] as $image) {
                        $resizedImage = InterventionImage::make($image['images'])
                            ->resize(1920, 1080)
                            ->encode();
                        $fileName = uniqid(rand() . '_');
                        $extension = $image['images']->extension();
                        $fileNameToStore = $fileName . '.' . $extension;

                        Storage::put($path . $fileNameToStore, $resizedImage);

                        Image::query()->create([
                            'owner_id' => auth()->id(),
                            'title' => $request->get('title') ?? null,
                            'file_name' => $fileNameToStore,
                        ]);
                    }
                });
            } catch (\Throwable $error) {
                Log::error($error);
                throw $error;
            }
        }
    }

    /**
     * 画像更新処理
     *
     * @param ImageUpdateRequest $request
     * @param string $path
     * @return void
     */
    public function updateImageInStorage(ImageUpdateRequest $request, string $path): void
    {
        $query = Image::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();

        /** @var Image $model */
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        DB::transaction(function () use ($request, $model, $path) {
            $resizedImage = InterventionImage::make($request->file()['file'])
                ->resize(1920, 1080)
                ->encode();
            $fileName = uniqid(rand() . '_');
            $extension = $request->file()['file']->extension();
            $fileNameToStore = $fileName . '.' . $extension;

            Storage::put($path . $fileNameToStore, $resizedImage);

            if (Storage::exists($path . $model->file_name)) {
                Storage::delete($path . $model->file_name);
            }

            $model->fill([
                'owner_id' => Auth::id(),
                'title' => $request->get('title'),
                'file_name' => $fileNameToStore,
                'is_selling' => $request->get('is_selling'),
            ]);
            $model->sava();
        });
    }

    /**
     * 画像削除処理
     *
     * @param Image $model
     * @return void
     */
    public function destroyImage(Image $model): void
    {
        DB::transaction(function () use ($model) {
            if (Storage::exists(ImageConst::IMAGE_PRODUCT_PATH . $model->file_name)) {
                Storage::delete(ImageConst::IMAGE_PRODUCT_PATH . $model->file_name);
                $model->delete();
            }
        });
    }
}
