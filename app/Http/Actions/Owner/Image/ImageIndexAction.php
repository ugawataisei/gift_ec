<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        $loginOwnerId = Auth::id();

        //将来的に複数の店舗を経営する使用になる為 get()で取得
        $query = Image::query();
        $query->where('owner_id', $loginOwnerId);
        $models = $query->paginate(10);

        return view('owner.image.index', compact('models'));
    }
}

