<?php

namespace App\Http\Actions\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExpiredOwnerDestroyAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(Request $request) :JsonResponse
    {
        $query = Owner::withTrashed();
        $query->findOrFail($request->get('id'));
        $model = $query->first();

        if ($model === null) {
            return response()->json([
                'error' => true,
                'message' => '削除対象のデータが存在しません',
            ]);
        }

        $model->forceDelete();
        return response()->json([
            'success' => true,
            'message' => 'オーナー情報を削除しました',
            'data' => [
                'id' => $request->get('id'),
            ]
        ]);
    }
}
