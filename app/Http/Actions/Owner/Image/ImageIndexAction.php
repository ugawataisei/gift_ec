<?php

namespace App\Http\Actions\Owner\Image;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(Request $request)
    {
        $loginOwnerId = Auth::id();

        //将来的に複数の店舗を経営する使用になる為 get()で取得
        $query = Shop::query();
        $query->where('owner_id', $loginOwnerId);
        $models = $query->get();

        return view('owner.shop.index', compact('models'));
    }
}

