<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductCreateAction extends Controller
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
        return view('owner.image.create');
    }
}



