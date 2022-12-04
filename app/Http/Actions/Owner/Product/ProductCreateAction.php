<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Owner;
use App\Models\SecondaryCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCreateAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        /** @var array $selectCategoryList */
        $query = SecondaryCategory::query();
        $query->select('id', 'name');
        $selectCategoryList = $query->get()
            ->pluck('name', 'id')
            ->toArray();

        /** @var Collection $images */
        $query = Image::query();
        $query->where('owner_id', Auth::id());
        $images = $query->get();

        /** @var Owner $model */
        $query = Owner::query();
        $model = $query->where('id', Auth::id())
            ->first();
        $shopId = $model->shop->id;

        return view('owner.product.create', compact(
            'selectCategoryList',
            'images',
            'shopId',
        ));
    }
}



