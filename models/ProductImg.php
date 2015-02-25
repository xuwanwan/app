<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/26
 * Time: 上午12:36
 */

class ProductImg extends \Eloquent {

    protected $table = 'product_imgs';

//    public $timestamps = false;

    protected $guarded = [];

    public function product() {
        return $this->belongsTo('Product','products_id');
    }
}