<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductEditAction extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:owners');
        $this->productService = $productService;
    }

    /**
     *
     * @param int $id
     * @return View|RedirectResponse
     */
    public function __invoke(int $id): View|RedirectResponse
    {
        $viewParams = $this->productService->returnProductEditeViewParams($id);

        return view('owner.product.edit', $viewParams);
    }
}



