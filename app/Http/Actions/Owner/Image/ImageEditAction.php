<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageEditAction extends Controller
{
    public function __construct()
    {
        //todo: 認証サービスに切り分ける
        $this->middleware('auth:owners');
        $this->middleware(function ($request, $next) {
            $requestShopId = $request->route()->parameters()['id'];
            /** @var Image $model */
            $query = Image::query();
            $query->findOrFail((int)$requestShopId);
            $model = $query->first();
            if ($model === null) {
                abort(404);
            }

            if (Auth::id() === $model->owner_id) {
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
        /** @var Image $model */
        $query = Image::query();
        $query->where('id', $id);
        $model = $query->first();

        return view('owner.image.edit', compact('model'));
    }
}

