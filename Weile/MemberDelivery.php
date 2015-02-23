<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/23
 * Time: 下午10:17
 */

namespace Weile;


class MemberDelivery extends \Eloquent {

    protected $fillable = [];
    protected $guarded = [];

    protected $table = 'member_delivery';


    public function member() {
        return $this->belongsTo('Weile\Member', 'member_id', 'id');
    }

}