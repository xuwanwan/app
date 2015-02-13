<?php
namespace Weile;

class District extends \Eloquent {
	protected $fillable = [];

	protected $table = 'district';



	public function children() {
		return $this->hasMany('Weile\District', 'parentid', 'id');
	}

	public function parent() {
		return $this->belongsTo('Weile\District', 'parentid', 'id');
	}


	public function provinceSelect() {
		return $this->where('parentid', '=','0')->lists('name', 'id');
	}
}