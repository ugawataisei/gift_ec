<?php

namespace App\Http\Actions\Admin\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OwnerEditAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function __invoke(Request $request, int $id): View
    {
        /** @var Owner $model */
        $query = Owner::query();
        $query->findOrFail($id);
        $model = $query->first();

        return view('admin.owner.edit', compact('model'));
    }
}
