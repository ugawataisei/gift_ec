<?php

namespace App\Http\Actions\Owner\Shop;

use App\Consts\CommonConst;
use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\Shop\ShopUpdateRequest;
use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShopUpdateAction extends Controller
{
    protected ShopService $shopService;

    public function __construct(ShopService $shopService)
    {
        $this->middleware('auth:owners');
        $this->shopService = $shopService;
    }

    /**
     *
     * @param ShopUpdateRequest $request
     * @return RedirectResponse
     */
    public function __invoke(ShopUpdateRequest $request): RedirectResponse
    {
        /** @var Shop $model */
        $query = Shop::query();
        $query->where('id', $request->get('id'));
        $model = $query->first();

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        $this->shopService->updateShopByRequest($request, $model);

        return redirect('owner/shop/edit/' . $request->get('id'))
            ->with([
                'status' => CommonConst::REDIRECT_STATUS_INFO,
                'message' => __('shop.success_message.update'),
            ]);
    }
}

