<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:34 AM
 */

namespace App\Service;
interface CartServiceInterface
{
    public function getCartData();

    public function getCart();
    public function addItemToCart($itemId,$session);
    public function removeItemFromCart($itemId,$session);
    public function removeItem($itemId,$session);
}