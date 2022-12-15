<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageDestroyAction extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->middleware('auth:owners');
        $this->imageService = $imageService;
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var Image $model */
        $query = Image::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();

        if ($model === null) {
            return response()->json([
                'error' => true,
                'message' => __('image.error_message.not_exist'),
            ]);
        }

        $this->imageService->destroyImage($model);

        return response()->json([
            'success' => true,
            'message' => __('image.success_message.destroy'),
            'data' => [
                'id' => $request->get('id'),
            ]
        ]);
    }
}
