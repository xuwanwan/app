<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/26
 * Time: 上午12:36
 */

class CompanyProductImg extends \Eloquent {

    protected $table = 'company_product_imgs';

//    public $timestamps = false;

    protected $guarded = [];

    public function product() {
        return $this->belongsTo('CompanyProduct','product_id');
    }
}