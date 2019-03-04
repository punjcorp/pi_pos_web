<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:36 AM
 */

namespace App\Service;

use Illuminate\Support\Facades\Log;
use App\User;
use App\Address;

class AccountService implements AccountServiceInterface
{

    public function getAccount($email)
    {
        return User::where('email','=',$email)->get();
    }

    public function addAccountAddress($user,$address)
    {
        $user->addresses()->save($address);
        Log::info('The address has been saved successfully');
    }

    public function addAccountPayment()
    {

    }

    public function getAccountAddresses($email)
    {
        Log::debug('The email is'.$email);
        $user=User::where('email','=',$email)->first();
        Log::debug('The user details has been found'.$user->email);
        return User::where('email','=',$email)->first()->addresses()->get();
    }

    public function saveAccountAddress($address)
    {
        return $address->save();
    }

    public function updateDefaultAddress($user,$addressId)
    {
        $result=false;
        $userAddresses=$user->addresses()->get();
        foreach($userAddresses as $address){
            if($address->address_id==$addressId){
                $address->primary='Y';
            }else{
                $address->primary='N';
            }
            $address->save();
        }
        $result=true;
        return $result;
    }

    public function deleteAddress($user, $addressId)
    {
        $result=false;
        $address=Address::find($addressId);

        $user->addresses()->detach($addressId);
        $address->delete();
        $result=true;
        return $result;
    }
}