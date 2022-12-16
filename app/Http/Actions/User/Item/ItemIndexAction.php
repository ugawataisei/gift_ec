<?php

namespace App\Http\Actions\User\Item;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ItemService;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ItemIndexAction extends Controller
{
    protected ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->middleware('auth:users');
        $this->itemService = $itemService;
    }

    /**
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request): View
    {
        /** @var Collection|Product $models */
        $models = $this->itemService->returnSellingItem();

        return view('user.item.index', compact('models'));
    }
}



