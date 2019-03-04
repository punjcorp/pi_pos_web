<?php
/**
 * Created by PhpStorm.
 * User: amitpunj
 * Date: 1/17/2019
 * Time: 11:34 AM
 */

namespace App\Service;
interface AccountServiceInterface
{
    public function getAccount($email);

    public function getAccountAddresses($email);
    public function addAccountAddress($user, $address);
    public function addAccountPayment();

    public function saveAccountAddress($address);

    public function updateDefaultAddress($user,$addressId);

    public function deleteAddress($user,$addressId);


}