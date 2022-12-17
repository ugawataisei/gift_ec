<?php

namespace App\Http\Actions\Owner\Image;

use App\Consts\CommonConst;
use App\Consts\ImageConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Image\ImageStoreRequest;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ImageStoreAction extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->middleware('auth:owners');
        $this->imageService = $imageService;
    }

    /**
     *
     * @param ImageStoreRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(ImageStoreRequest $request): RedirectResponse
    {
        $this->imageService->storeImageInStorage($request, CommonConst::IMAGE_PRODUCT_PATH);

        return redirect('owner/image/index')->with([
            'status' => CommonConst::REDIRECT_STATUS_INFO,
            'message' => __('image.success_message.store'),
        ]);
    }
}


