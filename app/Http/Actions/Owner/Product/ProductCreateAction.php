<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductCreateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(Request $request)
    {
        return view('owner.image.create');
    }
}



