<?php

namespace App;

class SKUElastic extends ElasticsearchModel
{
    protected $table = 'v_sku_dtls';
    protected $primaryKey = 'loc_sku_id';
    public $incrementing = false;

    /*
     * The elastic search related columns
     */
    protected static $_index = 'sku_idx';
    protected static $_type = 'sku';

    public $item_id;
    public $item_name;
    public $item_desc;

}
