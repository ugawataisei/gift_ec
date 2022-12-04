<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ImageCreateAction extends Controller
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



