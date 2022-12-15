<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageEditAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
        $this->middleware(function ($request, $next) {
            $query = Image::query();
            $query->findOrFail((int)$request->route()->parameters()['id']);

            /** @var Image $model */
            $model = $query->first();
            if ($model === null) {
                throw new NotFoundHttpException();
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
        $query = Image::query();
        $query->where('id', $id);
        $model = $query->first();

        /** @var Image $model */
        if ($model === null) {
            throw new NotFoundHttpException();
        }

        return view('owner.image.edit', compact('model'));
    }
}

