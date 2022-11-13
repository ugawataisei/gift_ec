<?php

namespace App\Http\Actions\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(Request $request)
    {
        $query = Owner::query();
        $query->select('id', 'name', 'email', 'created_at');
        $models = $query->get();

        return view('admin.owner.index', compact('models'));
    }
}
