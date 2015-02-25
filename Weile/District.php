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


    public function getPathAttribute() {

        $return = array();
        $return[] = $this->name;

        $ancestor = $this->parent;
        while($ancestor) {
            $return[] = $ancestor->name;
            $ancestor = $ancestor->parent;
        }
        return implode(' > ', array_reverse($return));
    }

}