<?php

namespace App\Http\Actions\User\Item;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ItemIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        /** @var Collection $models */
        $query = Product::query();
        $query->where('is_selling', 1);
        $models = $query->get();

        return view('user.item.index', compact('models'));
    }
}



