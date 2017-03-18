<?php

namespace App\Http\Controllers\Api;

use App\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * @var MenuRepository
     */
    private $menuRepository;

    /**
     * MenuController constructor.
     *
     * @param MenuRepository $menuRepository
     */
    public function __construct(MenuRepository $menuRepository)
    {
        parent::__construct();

        $this->menuRepository = $menuRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {
        $menus = Menu::where('account_id', $this->currentAccountId)->get();

        return response()->json(compact('menus'));
    }
}
