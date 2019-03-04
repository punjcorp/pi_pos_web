<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:36 AM
 */

namespace App\Service;

use Illuminate\Support\Facades\Log;
use App\Cart;
use App\Address;

class CheckoutService implements CheckoutServiceInterface
{

    public function saveShipmentAddress($cart, $addressId)
    {
        Log::debug('The address in service is ->'.$addressId);
        $existingShipments=$cart->shipments()->get();
        if(!empty($existingShipments)){
            foreach ($existingShipments as $shipment){
                $cart->shipments()->detach($shipment);
            }
        }


        $shipment=Address::find($addressId);
        Log::debug('The address id is ->'.$shipment->address_id);
        $cart->shipments()->save($shipment);
        Log::debug('The shipment address has been saved for the cart!');
    }

    public function authorizePayment()
    {
        // TODO: Implement auhtorizePayment() method.
    }
}