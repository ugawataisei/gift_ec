<?php

namespace App\Http\Actions\User\Item;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ItemShowAction extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    /**
     *
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function __invoke(Request $request, int $id): View
    {
        /** @var Product $model */
        $query = Product::query();
        $model = $query->findOrFail($id);

        $productQuantity = $model->getQuantity();
        if ($productQuantity > 9) $productQuantity = 9;

        $viewParams = [
            'model' => $model,
            'quantity' => $productQuantity,
            'shop' => $model->shop,
        ];

        return view('user.item.show', $viewParams);
    }
}
