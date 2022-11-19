<?php

namespace App\Http\Actions\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(Request $request)
    {
        $query = Shop::query();
        $model = $query->first();

        return view('owner.shop.index', compact('model'));
    }
}
