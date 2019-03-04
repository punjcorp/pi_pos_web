<?php

namespace App\Http\Controllers;

use App\Service\CartServiceInterface;
use App\Service\CheckoutServiceInterface;
use App\Service\PaypalServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $checkoutService;
    protected $paypalService;

    public function __construct(CheckoutServiceInterface $checkoutService, CartServiceInterface $cartService, PaypalServiceInterface $paypalService)
    {
        $this->checkoutService = $checkoutService;
        $this->cartService = $cartService;
        $this->paypalService = $paypalService;
    }

    public function checkoutEntry(Request $request)
    {
        // Step 1 - choose the shipping address
        $user = Auth::user();

        $selectedAddress = null;

        $cart = $this->cartService->getCart();
        $shipmentAddresses = $cart->shipments()->get();
        if ($shipmentAddresses != null && $shipmentAddresses->count() > 0) {
            foreach ($shipmentAddresses as $shipmentAddress) {
                $selectedAddress = $shipmentAddress;
                break;
            }
        }

        $addresses = $user->addresses()->get();

        if (!empty($selectedAddress))
            return View::make('/checkout/shipping')->with('userAddresses', $addresses)->with('selectedUserAddress', $selectedAddress);
        else
            return View::make('/checkout/shipping')->with('userAddresses', $addresses);

    }

    public function processShipment($addressId)
    {
        Log::info('The selected address for shipping is -> ' . $addressId);
        $cart = $this->cartService->getCart();
        $this->checkoutService->saveShipmentAddress($cart, $addressId);
        return View::make('/checkout/payment');
    }

    public function showPayment()
    {
        $this->paypalService->initializePaypal();
        $clientToken=$this->paypalService->generateClientId();
        return View::make('/checkout/payment')->with('clientToken',$clientToken);
    }

    public function confirmPayment()
    {
        $paymentNo=$_POST['paymentNo'];
        $result=$this->paypalService->confirmSale($paymentNo);
        return response()->json(['status' => 'success', 'result',$result]);
    }

}
