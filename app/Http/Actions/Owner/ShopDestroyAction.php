<?php

namespace App\Http\Actions\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopDestroyAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(Request $request)
    {
        return view('owner.shop.index');
    }
}
