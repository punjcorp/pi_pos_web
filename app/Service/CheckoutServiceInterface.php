<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:34 AM
 */

namespace App\Service;
interface CheckoutServiceInterface
{
    public function saveShipmentAddress($cart, $addressId);
    public function authorizePayment();
}