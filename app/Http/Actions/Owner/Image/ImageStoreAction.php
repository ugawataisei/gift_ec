<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ImageStoreRequest;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Throwable;

class ImageStoreAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param ImageStoreRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(ImageStoreRequest $request): RedirectResponse
    {
        if ($request->file()['files']) {
            try {
                DB::transaction(function () use ($request) {
                    foreach ($request->file()['files'] as $image) {
                        $resizedImage = InterventionImage::make($image['images'])
                            ->resize(1920, 1080)
                            ->encode();
                        $fileName = uniqid(rand() . '_');
                        $extension = $image['images']->extension();
                        $fileNameToStore = $fileName . '.' . $extension;
                        Storage::put('public/images/products/' . $fileNameToStore, $resizedImage);

                        $query = Image::query();
                        $query->create([
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

        return redirect('owner/image/index')->with([
            'status' => 'info',
            'message' => '商品画像の登録が完了しました',
        ]);
    }
}


