<?php

namespace App\Http\Actions\Admin\ExpiredOwner;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ExpiredOwnerIndexAction extends Controller
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
        $query = Owner::onlyTrashed();
        $models = $query->get();

        return view('admin.expired-owner.index', compact('models'));
    }
}
