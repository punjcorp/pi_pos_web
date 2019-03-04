<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'item_id';
    public $incrementing = false;

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class,'item_attributes','item_id','attribute_id');
    }

}
