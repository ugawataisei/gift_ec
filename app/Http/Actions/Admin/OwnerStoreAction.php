<?php

namespace App\Http\Actions\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OwnerStoreRequest;
use App\Models\Owner;
use Illuminate\Support\Facades\Hash;

class OwnerStoreAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function __invoke(OwnerStoreRequest $request)
    {
        if ($request->get('password') === $request->get('password_confirmation')) {
            $query = Owner::query();
            $query->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            return redirect('admin/owners/create')->with([
                'status' => 'info',
                'message' => 'オーナー登録が完了しました',
            ]);
        } else {

            return redirect('admin/owners/create')->with([
                'status' => 'alert',
                'message' => 'パスワードが一致していません',
            ]);
        }
    }
}

