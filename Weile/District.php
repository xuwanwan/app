<?php
namespace Weile;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeSelectOptions($query, $title="Select") {
        $selectVals[0] = $title;
        $selectVals += $this->whereParentid(0)->lists('name', 'id');
        return $selectVals;
    }

    //获取某一地区的下一级子地区
    public function scopeSelectSubOptions($query, $parentId=0) {
        $selectVals[0] = 'Select';
        $selectVals += $this->find($parentId)->children()->lists('name', 'id');
        return $selectVals;
    }

    //获取父级分类元素
    public static function ancestors($id)
    {
        $ancestors = static::where('id', '=', $id)->get();

        while ($ancestors->last()->parentid > 0)
        {
            $parent = static::where('id', '=', $ancestors->last()->parentid)->get();
            $ancestors = $ancestors->merge($parent);

        }

        return $ancestors;
    }


    //获取某一地区下所有子地区

    public static function getSSS($id) {
        $res = static::where('id', '=', $id)->get();
        static::getDescendants($id, $res);
        return $res;
    }

    public static function getDescendants($id, Collection &$r) {
#        var_dump($this->id);

        $currentId = $id;
        if ($currentId == '') return;


        $children = static::find($currentId)->children()->get();
#        var_dump($children->toArray());
        foreach ($children as $child) {
#            var_dump($child->id, $child->name);
#            $res = array_merge((array)$res,['id'=>$child->id, 'name'=>$child->name]);
            $r = $r->merge(static::where('id', '=', $child->id)->get());
#            var_dump($r->toArray());break;
            if($child->has('children')->get() !== null) {
                static::getDescendants($child->id, $r);
            }
        }

    }

}