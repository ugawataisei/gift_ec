<?php

namespace App\Http\Actions\Owner\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        if ($model === null) {
            throw new NotFoundHttpException();
        }

        /** @var Collection|Product $models */
        $models = $model->products;

        return view('owner.product.index', compact('models'));
    }
}


