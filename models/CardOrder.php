<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/3/5
 * Time: 下午6:03
 */

class CardOrder extends \Eloquent {
    protected $table = 'card_order';

    protected $guarded = [];

    //储值卡
    public function cardstoreds() {
        return $this->morphedByMany('CardStored','cardable');
    }
    //会员卡
    public function cardvips() {
        return $this->morphedByMany('CardVip','cardable')->withPivot('num');
    }
    //代金券
    public function cardvouchers() {
        return $this->morphedByMany('CardVoucher','cardable');
    }
    //优惠卡
    public function cardcoupons() {
        return $this->morphedByMany('CardCoupon','cardable');
    }

    public function scopeRecent() {
        return $this->orderBy('created_at', 'desc');
    }
}