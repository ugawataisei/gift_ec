<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageCreateAction extends Controller
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



