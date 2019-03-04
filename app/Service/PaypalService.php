<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:36 AM
 */

namespace App\Service;

use Illuminate\Support\Facades\Log;
use Braintree\Gateway;


class PaypalService implements PaypalServiceInterface
{

    protected $gateway;

    public function generateClientId()
    {
        return $this->gateway->clientToken()->generate();
    }

    public function initializePaypal()
    {
        $this->gateway=new Gateway([
            'accessToken' => 'access_token$sandbox$3fwqtq28htsggsrk$c4832ce1a184860fbb4c9a1bf222fd55',
        ]);
    }


    public function confirmSale($paymentNo)
    {
        $this->initializePaypal();
        $result = $this->gateway->transaction()->sale([
            "amount" => 10.00,
            'merchantAccountId' => 'USD',
            "paymentMethodNonce" => $paymentNo,
            "orderId" => 124,
            "descriptor" => [
                "name" => "company name*myurl.com"
            ]
        ]);
        if ($result->success) {
            Log::debug("Success ID: " . $result->transaction->id);
        } else {
            Log::debug("Error Message: " . $result->message);
        }

        return $result;

    }


}