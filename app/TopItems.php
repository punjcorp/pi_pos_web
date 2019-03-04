<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopItems extends Model
{
    protected $table = 'top_items';
    protected $primaryKey = 'top_item_id';

    public function item()
    {
        return $this->hasOne(SKU::class,'item_id','item_id');
    }

}
