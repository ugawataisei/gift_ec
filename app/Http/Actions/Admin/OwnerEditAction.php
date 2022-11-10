<?php

namespace App\Http\Actions\Admin;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerEditAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(Request $request, $id)
    {
        $query = Owner::query();
        $query->findOrFail($id);
        $model = $query->first();

        return view('admin.owner.edit', compact('model'));
    }
}
