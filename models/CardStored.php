<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/3/4
 * Time: 下午12:23
 */
class CardStored extends \Eloquent {

    protected $table = 'card_stored';

//    public $timestamps = false;

    protected $guarded = [];

    public function seller() {
        return $this->belongsTo('Seller', 'seller_id', 'id');
    }
    public function getMidImgUrlAttribute() {
        if ($this->attributes['logo']) {
            return asset('uploads/seller/thumbs/medium/' . $this->attributes['logo']);
        }
        return '';
    }
    public function getImgUrlAttribute() {
        if ($this->attributes['logo']) {
            return asset('uploads/seller/thumbs/small/' . $this->attributes['logo']);
        }
        return '';
    }

    public function orders() {
        return $this->morphToMany('CardOrder', 'cardable');
    }
}

