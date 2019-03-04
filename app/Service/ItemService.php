<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/21/2019
 * Time: 11:21 AM
 */

namespace App\Service;


use App\SKU;
use App\TopItems;
use Illuminate\Support\Facades\Log;

class ItemService implements ItemServiceInterface
{

    public function getAllItems()
    {
        return SKU::all();
    }

    public function getItemsByDept($deptId)
    {
        Log::debug('The dept Id is '.$deptId);
        if ($deptId == 0){
            return SKU::all();
        }
        else if ($deptId > 0)
            return SKU::where('item_hierarchy_id', '=', $deptId)->get();
    }

    public function getFeaturedItems()
    {
        return TopItems::where('category', '=', 'FEATURED')->get();
    }

    public function getTopSoldItems()
    {
        return TopItems::where('category', '=', 'SOLD')->get();
    }

    public function getTopSearchedItems()
    {
        return TopItems::where('category', '=', 'SEARCHED')->get();
    }
}