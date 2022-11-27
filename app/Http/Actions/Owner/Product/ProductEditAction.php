<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\SecondaryCategory;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductEditAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');
    }

    public function __invoke(Request $request, int $id)
    {
        $query = Product::query();
        $query->where('id', $id);
        $model = $query->first();

        if ($model === null) {
            return redirect()->route('owner.product.index')
                ->with([
                    'status' => 'alert',
                    'message' => '対象の商品情報が存在しませんでした',
                ]);
        }

        $query = SecondaryCategory::query();
        $query->select('id', 'name');
        $selectCategoryList = $query->get()
            ->pluck('name', 'id')
            ->toArray();

        $query = Stock::query();
        $query->where('product_id', $id);
        $stock = $query->first();

        $query = Image::query();
        $query->where('owner_id', Auth::id());
        $images = $query->get();

        return view('owner.product.edit', compact('model', 'selectCategoryList', 'stock', 'images'));
    }
}



