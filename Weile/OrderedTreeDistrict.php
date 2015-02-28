<?php
namespace Weile;

use Baum\Node;


class OrderedTreeDistrict extends Node
{


    protected $table = 'ordered_tree_district';

    protected $guarded = [];

    public $timestamps = false;


    public function getPathAttribute()
    {
        $ancestors = $this->getAncestors();
        $return = array();
        foreach($ancestors as $ancestor) {
            $return[] = $ancestor->name;
        }
        $return[] = $this->name;
        return implode(' > ', $return);
    }

    public static function selectOptions($title="Select") {
        $selectVals[0] = $title;
        $selectVals += static::whereNull('parent_id')->lists('name', 'id');
        return $selectVals;
    }

    public static function getPathById($id) {
       return static::find($id)->path;
    }
}