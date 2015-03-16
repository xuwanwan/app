<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/23
 * Time: 下午10:17
 */

namespace Weile;


class MemberBankcard extends \Eloquent {

    protected $fillable = [];
    protected $guarded = [];

    protected $table = 'member_bank_card';


    public function bankcard() {
        return $this->belongsTo('Weile\Member', 'member_id', 'id');
    }

}