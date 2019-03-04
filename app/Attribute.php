<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute_master';
    protected $primaryKey = 'attribute_id';


    public function items()
    {
        return $this->belongsToMany(Item::class,'item_attributes','attribute_id','item_id');
    }
}
