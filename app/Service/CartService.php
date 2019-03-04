<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:36 AM
 */

namespace App\Service;

use App\Cart;
use App\CartItem;
use App\SKU;
use Illuminate\Support\Facades\Log;

class CartService implements CartServiceInterface
{
    public function getCart()
    {
        return Cart::where('created_by', '=', 'admin')->first();
    }

    public function addItemToCart($itemId, $session)
    {
        Log::debug('The item ' . $itemId . ' needs to be added to cart');
        $cart = $this->getExistingCart($session);

        if ($cart !== null) {
            Log::debug('Cart has data');
            $this->addToCartItemQty($cart, $itemId);
        } else {
            Log::debug('No data found in cart');
            $this->createNewCart($session, $itemId);
        }

    }


    private function addToCartItemQty($cart, $itemId)
    {
        $cartItems = $cart->cartItems()->get();
        if ($cartItems !== null) {
            Log::debug('cart items arrays is not null' . $cartItems);
            foreach ($cartItems as $cartItem) {
                if ($cartItem->item_id == $itemId) {
                    Log::debug('Found item already existing in  cart');
                    $retrievedCartItem = CartItem::find($cartItem->cart_item_id);
                    $retrievedCartItem->qty = $retrievedCartItem->qty + 1;
                    $retrievedCartItem->discount = 0;
                    $retrievedCartItem->tax = 0;
                    $retrievedCartItem->total = $retrievedCartItem->price * $retrievedCartItem->qty;
                    $retrievedCartItem->save();
                    return;
                }
                Log::debug($cartItem->item_id . ' does not match ' . $itemId);
            }
        }
        Log::debug('item does not exist in cart, hence creating');
        $this->createNewCartItem($cart, $itemId);
    }

    private function createNewCart($session, $itemId)
    {
        $cart = new Cart;

        $cart->name = 'cart created on';
        $cart->instructions = '';
        $cart->status = 'O';
        $cart->created_by = 'admin';
        $cart->created_date = new DateTime();

        $cart->save();

        $this->createNewCartItem($cart, $itemId);
    }

    private function createNewCartItem($cart, $itemId)
    {
        $item = SKU::find($itemId . "-1234");
        $cartItem = new CartItem;

        $cartItem->item_id = $item->item_id;
        $cartItem->name = $item->item_name;
        $cartItem->description = $item->item_desc;
        $cartItem->qty = 1;
        $cartItem->price = $item->item_price;
        $cartItem->tax = 0;
        $cartItem->discount = 0;
        $cartItem->total = $item->item_price;
        $cartItem->cart_id = $cart->cart_id;
        $cartItem->save();

    }

    private function getExistingCart($session)
    {
        if ($session->has('cart')) {
            Log::debug('The cart exists in session');
            return $session->get('cart');
        }
        $cart = Cart::where('created_by', '=', 'admin')->first();
        if ($cart !== null) {
            Log::debug('The cart retrieved from database');
            $session->put('cart', $cart);
            return $cart;
        }
        Log::debug('No cart found!!');
        return null;
    }


    public function removeItemFromCart($itemId, $session)
    {
        Log::debug('The item ' . $itemId . ' needs to be added to cart');
        $cart = $this->getExistingCart($session);

        if ($cart !== null) {
            Log::debug('Cart has data');
            $this->removeItemQty($cart, $itemId);
        }
    }

    private function removeItemQty($cart, $itemId)
    {
        $cartItems = $cart->cartItems()->get();
        if ($cartItems !== null) {
            Log::debug('cart items arrays is not null' . $cartItems);
            foreach ($cartItems as $cartItem) {
                if ($cartItem->item_id == $itemId) {
                    Log::debug('Found item already existing in  cart');
                    $retrievedCartItem = CartItem::find($cartItem->cart_item_id);
                    if ($retrievedCartItem->qty > 1) {
                        $retrievedCartItem->qty = $retrievedCartItem->qty - 1;
                    } else {
                        $retrievedCartItem->delete();
                        return;
                    }
                    $retrievedCartItem->discount = 0;
                    $retrievedCartItem->tax = 0;
                    $retrievedCartItem->total = $retrievedCartItem->price * $retrievedCartItem->qty;
                    $retrievedCartItem->save();
                    return;
                }
                Log::debug($cartItem->item_id . ' does not match ' . $itemId);
            }
        }
    }

    public function removeItem($itemId, $session)
    {
        Log::debug('The item ' . $itemId . ' needs to be added to cart');
        $cart = $this->getExistingCart($session);

        if ($cart !== null) {
            Log::debug('Cart has data, proceed with searching the cart');
            $this->removeItemInDB($cart, $itemId);
        }
    }

    private function removeItemInDB($cart, $itemId)
    {
        $cartItems = $cart->cartItems()->get();
        if ($cartItems !== null) {
            Log::debug('cart items arrays is not null' . $cartItems);
            foreach ($cartItems as $cartItem) {
                if ($cartItem->item_id == $itemId) {
                    Log::debug('Found item already existing in  cart');
                    $retrievedCartItem = CartItem::find($cartItem->cart_item_id);
                    $retrievedCartItem->delete();
                    return;
                }
                Log::debug($cartItem->item_id . ' does not match ' . $itemId);
            }
        }
    }

    public function getCartData()
    {
        $cart = $this->getCart();
        $cartCounts= CartItem::where('cart_id', '=', $cart->cart_id)->selectRaw('sum(price * qty) as price, sum(qty) as qty, sum(tax) as tax, sum(total) as total')->first();
        Log::info('cart has the ' . $cartCounts['qty'] . ' no of items');

        $cart->sub_total=$cartCounts['price'];
        $cart->discount_total=$cartCounts['discount'];
        $cart->tax_total=$cartCounts['tax'];
        $cart->total=$cartCounts['total'];

        Log::debug('The requested cart data has been loaded successfully');
        $cartData=array('cart'=>$cart,'cartCount'=>$cartCounts['qty']);

        return $cartData;
    }
}