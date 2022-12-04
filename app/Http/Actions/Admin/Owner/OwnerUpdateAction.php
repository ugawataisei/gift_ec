<?php

namespace App\Http\Actions\Admin\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Owner\OwnerUpdateRequest;
use App\Models\Owner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class OwnerUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     *
     * @param OwnerUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(OwnerUpdateRequest $request): RedirectResponse
    {
        $query = Owner::query();
        $query->findOrFail($request->get('id'));
        $model = $query->first();
        $model->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return redirect("admin/owners/edit/{$request->get('id')}")
            ->with(['status' => 'info', 'message' => 'オーナー情報を更新しました',]);
    }
}
