<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:34 AM
 */

namespace App\Service;
interface ItemServiceInterface
{
    public function getAllItems();

    public function getItemsByDept($deptId);
    public function getFeaturedItems();
    public function getTopSoldItems();
    public function getTopSearchedItems();

}