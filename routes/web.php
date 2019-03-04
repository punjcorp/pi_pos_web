<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/items/dept/{deptId}','ItemController@itemsByDept');
Route::get('/items/top/featured','ItemController@showTopFeatured');
Route::get('/items/top/sold','ItemController@showTopSold');
Route::get('/items/top/searched','ItemController@showTopSearched');
Route::get('/item/{itemId}','ItemController@showDetails');


Route::get('/cart','CartController@show');
Route::get('/cart/addItem','CartController@addItem');
Route::get('/cart/addItemQty','CartController@addItemQty');
Route::get('/cart/removeItemQty','CartController@removeItemQty');
Route::get('/cart/removeItem','CartController@removeItem');


Route::group(['middleware' => ['auth']], function () {

    // Account Address Management URL starts
    Route::get('/account/address/manage','AccountController@show')->name('manageAddress');
    Route::get('/account/address/add','AccountController@addAddress')->name('addAddress');
    Route::post('/account/address/save','AccountController@save')->name('saveAddress');
    Route::get('/account/address/edit/{addressId}','AccountController@showAddress')->name('showAddress');
    Route::post('/account/address/update','AccountController@saveModified')->name('updateAddress');
    Route::get('/account/address/updatePrimary/{addressId}','AccountController@updatePrimary');

    Route::get('/account/address/delete/{addressId}','AccountController@deleteAddress')->name('deleteAddress');
    // Account Address Management URL ends


    // Checkout URL mapping starts
    Route::get('/cart/checkout','CheckoutController@checkoutEntry')->name('checkoutEntry');
    Route::get('/checkout/shipping/{addressId}','CheckoutController@processShipment');
    Route::get('/checkout/payment','CheckoutController@showPayment')->name('paymentStep');
    Route::post('/checkout/payment/confirmation','CheckoutController@confirmPayment')->name('confirmPaymentStep');

    // Checkout URL mapping ends

});


