<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/19/2019
 * Time: 2:50 PM
 */
namespace App\Http\ViewComposers;

use App\Service\CartServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartComposer
{

    protected $users;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function compose(View $view)
    {
        $cartData=Session::get('cartData');
        if($cartData===null){
            $cartData= $this->cartService->getCartData();
            Log::debug('The cart data from db has been loaded successfully');
            Session::put('cartData',$cartData);
        }
        $view->with($cartData);
    }
}