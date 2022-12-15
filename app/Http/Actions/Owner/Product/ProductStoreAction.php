<?php

namespace App\Http\Actions\Owner\Product;

use App\Consts\CommonConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Product\ProductStoreRequest;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProductStoreAction extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:owners');
        $this->productService = $productService;
    }

    /**
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(ProductStoreRequest $request): RedirectResponse
    {
        $this->productService->storeProduct($request);

        return redirect('owner/product/index')->with([
            'status' => CommonConst::REDIRECT_STATUS_INFO,
            'message' => __('product.success_message.store'),
        ]);
    }
}



