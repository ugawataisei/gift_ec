<?php

namespace App\Http\Actions\Admin\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OwnerDestroyAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        /** @var Owner $model */
        $query = Owner::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();
        if ($model === null) {
            return response()->json([
                'error' => true,
                'message' => '削除対象のデータが存在しません',
            ]);
        }
        $model->delete();

        return response()->json([
            'success' => true,
            'message' => 'オーナー情報を削除しました',
            'data' => [
                'id' => $request->get('id'),
            ]
        ]);
    }
}

