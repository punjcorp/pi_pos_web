<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'cart_item_id';
    public $timestamps = false;

    protected $fillable = ['item_id', 'name', 'description', 'qty', 'price', 'tax', 'discount', 'total', 'cart_id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function item()
    {
        return $this->hasOne(Item::class);
    }

}
