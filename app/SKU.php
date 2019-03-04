<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SKU extends Model
{
    protected $table = 'v_sku_dtls';
    protected $primaryKey = 'loc_sku_id';
    public $incrementing = false;



}
