<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/3/13
 * Time: 下午6:21
 */


class Advertise extends \Eloquent {
    protected $table = 'advertise';

    protected $guarded = [];

    public function imgs() {
        return $this->hasMany('AdvertiseImg', 'advertise_id');
    }

    public function tags() {
        return $this->belongsToMany('AdvertiseTag', 'advertise_advertise_tag', 'advertise_id', 'advertise_tag_id');
    }

    public function company() {
        return $this->belongsTo('Company');
    }


    public function save(array $options=[]) {
        #      var_dump($value);
        parent::save($options);


        $value = array_get($this->attributes, 'detail');
        //同步附图到imgs表
        preg_match_all('#<img.*src="(.*)"[^>]*>#Uis', $value, $m);

        if (empty($m)) return false;
        $data = [];
        foreach ($m[1] as $item) {
            $data[] = new AdvertiseImg(['path'=>$item]);
        }
        $this->imgs()->delete();
        $this->imgs()->saveMany($data);

        return true;
    }
}