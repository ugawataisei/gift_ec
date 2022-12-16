<?php

namespace App\Http\Actions\User\Item;

use App\Http\Controllers\Controller;
use App\Services\ItemService;
use Illuminate\Contracts\View\View;

class ItemShowAction extends Controller
{
    protected ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->middleware('auth:users');
        $this->itemService = $itemService;
    }

    /**
     *
     * @param int $id
     * @return View
     */
    public function __invoke(int $id): View
    {
        $viewParams = $this->itemService->returnItemShowViewParams($id);

        return view('user.item.show', $viewParams);
    }
}
