<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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
        $query = Image::query();
        $query->where('owner_id', Auth::id());
        $query->whereNull('deleted_at');
        /** @var Collection|Image $models */
        $models = $query->paginate(10);

        return view('owner.image.index', compact('models'));
    }
}

