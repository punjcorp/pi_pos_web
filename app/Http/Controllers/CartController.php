<?php

namespace App\Http\Controllers;

use App\Service\CartServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function show(Request $request)
    {
        return View::make('/order/cart-details');
    }

    public function processShipment()
    {
        return View::make('/order/shipment-details');
    }

    private function getCartData()
    {
        return Session::put('cartData');
    }

    private function updateCartSession()
    {
        $cartData= $this->cartService->getCartData();
        Log::debug('The cart data has been updated successfully');
        Session::put('cartData',$cartData);
    }

    private function updateCartCount($session, $cart)
    {
        $cartItems = $cart->cartItems()->get();
        $count = 0;
        $subTotal=0.00;
        $discountTotal=0.00;
        $taxTotal=0.00;
        $total=0.00;
        foreach ($cartItems as $cartItem) {
            $count = $count + $cartItem->qty;
            $subTotal = $subTotal+($cartItem->price * $cartItem->qty);
            $discountTotal = $discountTotal +$cartItem->discount;
            $taxTotal = $taxTotal +$cartItem->tax;
            $total = $total+$cartItem->total;
        }
        $session->put('cartCount', $count);

        $cart->sub_total=$subTotal;
        $cart->discount_total=$discountTotal;
        $cart->tax_total=$taxTotal;
        $cart->total=$total;

        $session->put('cart', $cart);
    }


    public function addItem(Request $request)
    {
        $this->addItemInCart($request);
        return Redirect('/home');
    }

    private function addItemInCart($request)
    {
        $session = $request->session();
        $itemId = $request->input('itemId');

        $cart = $this->cartService->addItemToCart($itemId, $session);
        $this->updateCartSession($session, $cart);

    }


    public function addItemQty(Request $request)
    {
        $this->addItemInCart($request);
        return Redirect('/cart');
    }

    public function removeItemQty(Request $request)
    {
        $session = $request->session();
        $itemId = $request->input('itemId');

        $cart = $this->cartService->removeItemFromCart($itemId, $session);
        $this->updateCartSession($session, $cart);

        return Redirect('/cart');
    }

    public function removeItem(Request $request)
    {
        $session = $request->session();
        $itemId = $request->input('itemId');

        $cart = $this->cartService->removeItem($itemId, $session);
        $this->updateCartSession($session, $cart);

        return Redirect('/cart');
    }
}
