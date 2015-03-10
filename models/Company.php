<?php

class Company extends \Eloquent {

    public $timestamps = false;

    protected $table = 'company';

    protected $fillable = [];


    public function districts() {
        return $this->belongsTo('Weile\OrderedTreeDistrict', 'district', 'id');
    }

    public function getDistrictPathAttribute() {
        return \Weile\OrderedTreeDistrict::getPathById($this->district);
    }

}