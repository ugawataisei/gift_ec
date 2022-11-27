<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(Request $request)
    {
        dd($request);
    }
}


