<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/25
 * Time: 下午3:55
 */

class SellerDetail extends \Eloquent {
    protected $table = 'seller_detail';

    public $timestamps = false;

    protected $guarded = [];

    public function seller() {
        return $this->belongsTo('Seller','seller_id');
    }
}