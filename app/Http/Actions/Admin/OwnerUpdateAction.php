<?php

namespace App\Http\Actions\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OwnerUpdateRequest;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnerUpdateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(OwnerUpdateRequest $request)
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
