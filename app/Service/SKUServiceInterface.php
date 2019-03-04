<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:34 AM
 */

namespace App\Service;
interface SKUServiceInterface
{
    public function getSearchedSKUs(String $searchText);

}