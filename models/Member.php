<?php

class Member extends \Eloquent {

    public $timestamps = false;

    protected $fillable = [];


    public function districts() {
        return $this->belongsTo('Weile\OrderedTreeDistrict', 'district', 'id');
    }

    public function getDistrictPathAttribute() {
        return \Weile\OrderedTreeDistrict::getPathById($this->district);
    }

    public function setPasswordAttribute($value) {
        if($value == '') {
            $this->attributes['password'] = $this->attributes['password'];
        } else {
            $this->attributes['password'] = \Hash::make($value);
        }
    }

    //邀请人
    public function friends()
    {
        return $this->belongsToMany('Member', 'friends_users', 'member_id', 'friend_id');
    }

    public function getTypeAttribute($type) {
        $return = '';
        switch($type) {
            case "1":
                $return = "省级代理";
                break;
            case "2":
                $return = "市级代理";
                break;
            case "3":
                $return = "门店代理";
                break;
            case "4":
                $return = "公司";
                break;
        }
        return $return;
    }

    public function setTypeAttribute($value) {
        switch($value) {
            case "省级代理":
                $this->attributes['type'] = 1;
                break;
            case "市级代理":
                $this->attributes['type'] = 2;
                break;
            case "门店代理":
                $this->attributes['type'] = 3;
                break;
            case "公司":
                $this->attributes['type'] = 4;
                break;
        }
    }

}