<?php

namespace App\Http\Actions\Owner\Product;

use App\Consts\CommonConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Product\ProductUpdateRequest;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProductUpdateAction extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->middleware('auth:owners');
        $this->productService = $productService;
    }

    /**
     *
     * @param ProductUpdateRequest $request
     * @return RedirectResponse
     * @throws Throwable
     */
    public function __invoke(ProductUpdateRequest $request): RedirectResponse
    {
        $this->productService->updateProduct($request);

        return redirect()->route('owner.product.edit', ['id' => $request->get('id')])
            ->with([
                'status' => CommonConst::REDIRECT_STATUS_INFO,
                'message' => __('product.success_message.update'),
            ]);
    }
}


