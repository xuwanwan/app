<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/25
 * Time: 下午3:55
 */

class CompanyProductDetail extends \Eloquent {
    protected $table = 'company_product_detail';

//    public $timestamps = false;

    protected $guarded = [];

    public function product() {
        return $this->belongsTo('CompanyProduct','product_id');
    }
}