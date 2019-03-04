<?php

namespace App\Http\Controllers;

use App\Service\ItemServiceInterface;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    protected $itemService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ItemServiceInterface $itemService)
    {
        //$this->middleware('auth');
        $this->itemService = $itemService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allItems=$this->itemService->getAllItems();
        return View::make('sku/skulist')->with('skus', $allItems);

    }

    public function itemsByDept(){

    }


}
