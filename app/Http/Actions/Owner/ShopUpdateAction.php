<?php

namespace App\Http\Actions\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(Request $request)
    {
        $query = Shop::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();

        if ($model === null) {
            return redirect('owner/shop/edit/' . $request->get('id'))
                ->with([
                    'status' => 'alert',
                    'message' => '更新対象の店舗情報が存在しませんでした',
                ]);
        }

        DB::transaction(function () use ($request, $model) {
            //アップロード画像処理
            $file = Storage::putFile('public/images/shop', $request->file()['file']);

            //データベース更新
            $model->update(
                [
                    'name' => $request->get('name'),
                    'information' => nl2br($request->get('information')),
                    'file_name' => $file,
                    'is_selling' => $request->get('is_selling'),
                ]
            );
        });

        return redirect('owner/shop/edit/' . $request->get('id'))
            ->with([
                'status' => 'info',
                'message' => '店舗情報を更新しました',
            ]);
    }
}

