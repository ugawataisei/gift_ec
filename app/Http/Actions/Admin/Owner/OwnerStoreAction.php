<?php

namespace App\Http\Actions\Admin\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Owner\OwnerStoreRequest;
use App\Models\Owner;
use App\Models\Shop;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class OwnerStoreAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     *
     * @param OwnerStoreRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(OwnerStoreRequest $request): RedirectResponse
    {
        if ($request->get('password') === $request->get('password_confirmation')) {
            try {
                DB::transaction(function () use ($request) {
                    $query = Owner::query();
                    $owner = $query->create([
                        'name' => $request->get('name'),
                        'email' => $request->get('email'),
                        'password' => Hash::make($request->get('password')),
                    ]);

                    $query = Shop::query();
                    $query->create([
                        'owner_id' => $owner->id,
                        'name' => 'ここに店名が入ります',
                        'information' => '',
                        'file_name' => '',
                        'is_selling' => false,
                    ]);
                });
            } catch (\Throwable $error) {
                Log::error($error);
                throw $error;
            }

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

