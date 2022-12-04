<?php

namespace App\Http\Actions\Owner\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopIndexAction extends Controller
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
        /** @var Collection $models */
        $query = Shop::query();
        $query->where('owner_id', Auth::id());
        $models = $query->get();

        return view('owner.shop.index', compact('models'));
    }
}
