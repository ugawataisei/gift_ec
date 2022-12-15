<?php

namespace App\Http\Actions\Owner\Image;

use App\Consts\CommonConst;
use App\Consts\ImageConst;
use App\Http\Controllers\Controller;
use App\Services\ImageService;
use App\Http\Requests\Owner\Image\ImageUpdateRequest;
use Illuminate\Http\RedirectResponse;

class ImageUpdateAction extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->middleware('auth:owners');
        $this->imageService = $imageService;
    }

    /**
     *
     * @param ImageUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(ImageUpdateRequest $request): RedirectResponse
    {
        $this->imageService->updateImageInStorage($request, ImageConst::IMAGE_PRODUCT_PATH);

        return redirect('owner/image/edit/' . $request->get('id'))
            ->with([
                'status' => CommonConst::REDIRECT_STATUS_INFO,
                'message' => __('image.success_message.update'),
            ]);
    }
}


