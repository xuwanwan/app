<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/26
 * Time: 上午12:36
 */

class SellerImg extends \Eloquent {

    protected $table = 'seller_imgs';

//    public $timestamps = false;

    protected $guarded = [];

    public function product() {
        return $this->belongsTo('Seller','seller_id');
    }
}