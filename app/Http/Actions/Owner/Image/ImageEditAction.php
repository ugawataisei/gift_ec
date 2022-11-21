<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageEditAction extends Controller
{
    public function __construct()
    {
        //todo: 認証サービスに切り分ける
        $this->middleware('auth:owners');

        //他の店舗情報を閲覧できないようにリクエストパラメータと比較
        $this->middleware(function ($request, $next) {
            $loginOwnerId = Auth::id();
            $requestShopId = $request->route()->parameters()['id'];

            $query = Shop::query();
            $query->findOrFail((int)$requestShopId);
            $model = $query->first();

            if ($model === null) {
                abort(404);
            }

            $ownerId = $model->owner->id;
            if ($loginOwnerId === $ownerId) {
                return $next($request);
            } else {
                abort(404);
            }
        });
    }

    public function __invoke(Request $request, int $id)
    {
        $query = Shop::query();
        $query->where('id', $id);
        $model = $query->first();

        return view('owner.shop.edit', compact('model'));
    }
}

