<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address_master';
    protected $primaryKey = 'address_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address1', 'address2', 'address_type', 'city', 'state', 'country', 'pincode', 'primary',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'web_user_address','address_id','user_id');
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class,'cart_shipment','address_id','cart_id');
    }
}
