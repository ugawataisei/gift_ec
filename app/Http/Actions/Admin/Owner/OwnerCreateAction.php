<?php

namespace App\Http\Actions\Admin\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OwnerCreateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return view('admin.owner.create');
    }
}


