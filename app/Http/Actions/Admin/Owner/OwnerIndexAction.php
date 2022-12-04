<?php

namespace App\Http\Actions\Admin\Owner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OwnerIndexAction extends Controller
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
        /** @var Collection $models */
        $query = Owner::query();
        $query->select('id', 'name', 'email', 'created_at');
        $models = $query->get();

        return view('admin.owner.index', compact('models'));
    }
}
