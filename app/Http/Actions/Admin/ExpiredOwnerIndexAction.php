<?php

namespace App\Http\Actions\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class ExpiredOwnerIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(Request $request)
    {
        $query = Owner::onlyTrashed();
        $models = $query->get();

        return view('admin.expired-owner.index', compact('models'));
    }
}
