<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/25
 * Time: 下午12:03
 */

class ProductTag extends \Eloquent {

    protected $table = 'product_tags';

    public $timestamps = false;

    protected $fillabe = ['description'];

    public function products() {
        return $this->belongsToMany('Product', 'product_tags', 'product_tag_id', 'product_id');
    }
}