<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    public $timestamps = false;

    public function cartItems()
    {
        return $this->hasMany(CartItem::class,'cart_id','cart_id');
    }

    public function shipments()
    {
        return $this->belongsToMany(Address::class,'cart_shipment','cart_id','address_id');
    }

}
