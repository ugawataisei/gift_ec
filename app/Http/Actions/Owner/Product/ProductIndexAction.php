<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductIndexAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        /** @var Shop $model */
        $query = Shop::query();
        $query->where('owner_id', Auth::id());
        $model = $query->first();
        /** @var Collection $models */
        $models = $model->products;

        if ($models === null) {
            return redirect()->route('owner.shop.index')->with([
                'status' => 'alert',
                'message' => '商品情報がまだ登録されていません。商品情報を登録してください。'
            ]);
        }

        return view('owner.product.index', compact('models'));
    }
}


