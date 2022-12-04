<?php

namespace App\Http\Actions\Owner\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopEditAction extends Controller
{
    public function __construct()
    {
        //todo: 認証サービスに切り分ける
        $this->middleware('auth:owners');
        $this->middleware(function ($request, $next) {
            /** @var Shop $model */
            $query = Shop::query();
            $query->findOrFail((int)$request->route()->parameters()['id']);
            $model = $query->first();
            if ($model === null) {
                abort(404);
            }
            if (Auth::id() === $model->owner->id) {
                return $next($request);
            } else {
                abort(404);
            }
        });
    }

    /**
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function __invoke(Request $request, int $id): View
    {
        /** @var Shop $model */
        $query = Shop::query();
        $query->where('id', $id);
        $model = $query->first();

        return view('owner.shop.edit', compact('model'));
    }
}

