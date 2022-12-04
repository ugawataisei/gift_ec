<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductDestroyAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
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
                'message' => '削除対象のデータが存在しません',
            ]);
        }
        DB::transaction(function () use ($model) {
            if (Storage::exists('public/images/products/' . $model->file_name)) {
                Storage::delete('public/images/products/' . $model->file_name);
                $model->delete();
            }
        });

        return response()->json([
            'success' => true,
            'message' => '登録画像を削除しました',
            'data' => [
                'id' => $request->get('id'),
            ]
        ]);
    }
}
