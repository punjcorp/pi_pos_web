<?php

namespace App\Http\Controllers;

use App\Item;
use App\SKU;
use App\Service\ItemServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
    }

    public function showDetails(Request $request, $itemId)
    {
        //$itemId=Input::get('itemId');
        Log::debug('Received request for item' . $itemId);
        $itemDetails = Item::find($itemId);
        Log::debug('retrieved item' . $itemDetails->name);

        $item = SKU::find($itemId . "-1234");
        Log::debug('retrieved item' . $item->name);

        $itemData = array(
            'item' => $item,
            'attrs' => $itemDetails->attributes
        );

        return View::make('sku/item-details')->with('itemData', $itemData);
    }


    public function itemsByDept(Request $request, $deptId){
        Log::info('Calling api with dept id '.$deptId);
        $skus=$this->itemService->getItemsByDept($deptId);
        return View::make('sku/skulist')->with('skus', $skus);
    }


    public function showTopFeatured(){
        $featuredItems=$this->itemService->getFeaturedItems();
        return View::make('sku/top/featured-items')->with('featuredItems', $featuredItems);
    }

    public function showTopSold(){
        $soldItems=$this->itemService->getTopSoldItems();
        return View::make('sku/top/sold-items')->with('soldItems', $soldItems);
    }

    public function showTopSearched(){
        $searchedItems=$this->itemService->getTopSearchedItems();
        return View::make('sku/top/searched-items')->with('searchedItems', $searchedItems);
    }
}
