<?php

namespace App\Http\Controllers;

use App\Address;
use App\Service\AccountServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountServiceInterface $accountService)
    {
        $this->accountService = $accountService;
    }

    public function show()
    {
        $user = Auth::user();
        $userAddresses = $this->accountService->getAccountAddresses($user->email);
        return View::make('account/address')->with('userAddresses', $userAddresses);
    }

    public function showAddress(Request $request,$addressId)
    {
        $userAddress = Address::find($addressId)->first();

        return View::make('account/edit-address')->with('address', $userAddress);
    }

    public function addAddress()
    {
        return View::make('account/add-address');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'address1' => ['required', 'string', 'min:2', 'max:150'],
            'address2' => ['max:150'],
            'address_type' => ['required', 'string', 'max:150'],
            'city' => ['required', 'string', 'min:2', 'max:30'],
            'state' => ['required', 'string', 'min:3', 'max:45'],
            'country' => ['required', 'string', 'min:2', 'max:45'],
            'pincode' => ['required', 'string', 'min:5', 'max:6'],
        ]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();

        $this->validator($request->all())->validate();


        $address = new Address([
            'address1' => Input::post('address1'),
            'address2' => Input::post('address2'),
            'city' => Input::post('city'),
            'state' => Input::post('state'),
            'country' => Input::post('country'),
            'pincode' => Input::post('pincode'),
            'address_type' => Input::post('address_type'),
            'primary' => 'N',
        ]);


        $this->accountService->addAccountAddress($user, $address);

        return View::make('account/add-address')->with('result', 'success');
    }

    public function saveModified(Request $request)
    {
        Log::debug('I reached with modified details');
        $user = Auth::user();

        $this->validator($request->all())->validate();

        $addressId = Input::post('address_id');

        $address = Address::find($addressId)->first();
        $address->address1 = Input::post('address1');
        $address->address2 = Input::post('address2');
        $address->city = Input::post('city');
        $address->state = Input::post('state');
        $address->country = Input::post('country');
        $address->pincode = Input::post('pincode');
        $address->address_type = Input::post('address_type');

        $this->accountService->saveAccountAddress($address);

        return View::make('account/edit-address')->with('address', $address)->with('status', 'success');
    }

    public function updatePrimary($addressId)
    {
        $user = Auth::user();

        $result = $this->accountService->updateDefaultAddress($user, $addressId);
        Log::debug('The result for updating the address as default is -> '.$result);
        return redirect()->back()->with('defaultResult', $result);
    }

    public function deleteAddress($addressId)
    {
        $user = Auth::user();
        $result = $this->accountService->deleteAddress($user, $addressId);
        Log::debug('The result for deleting the address is -> '.$result);
        return redirect()->back()->with('deleteResult', $result);
    }

}
