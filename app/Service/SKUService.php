<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/21/2019
 * Time: 11:21 AM
 */

namespace App\Service;


use App\SKUElastic;

class SKUService implements SKUServiceInterface
{

    public function getSearchedSKUs(String $searchText)
    {
        $query = new QueryBuilder();
        $query->match('item_name', $searchText);
        return SKUElastic::search($query);
    }
}