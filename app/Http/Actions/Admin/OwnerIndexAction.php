<?php

namespace App\Http\Actions\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OwnerIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(Request $request)
    {
        dd($request);
        return null;
    }
}
