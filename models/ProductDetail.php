<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/25
 * Time: 下午3:55
 */

class ProductDetail extends \Eloquent {
    protected $table = 'product_detail';

//    public $timestamps = false;

    protected $guarded = [];

    public function product() {
        return $this->belongsTo('Product','products_id');
    }
}