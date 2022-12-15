<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Contracts\View\View;

class ProductCreateAction extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:owners');
        $this->productService = $productService;
    }

    /**
     *
     * @return View
     */
    public function __invoke(): View
    {
        $viewParams = $this->productService->returnProductCreateViewParams();

        return view('owner.product.create', $viewParams);
    }
}



