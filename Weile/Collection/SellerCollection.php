<?php
namespace Weile;

use Illuminate\Support\Collection;

class SellerCollection extends Collection
{
    public function orderBy($attribute, $order = 'asc')
    {
        $this->sortBy(function($model) use ($attribute) {
            return $model->{$attribute};
        });

        if ($order == 'desc') {
            $this->items = array_reverse($this->items);
        }

        return $this;
    }

    public function paginate($perPage) {
        $pagination = \App::make('paginator');
        $count = $this->count();
        $page = $pagination->getCurrentPage($count);
        $items = $this->slice(($page - 1) * $perPage, $perPage)->all();
        $pagination = $pagination->make($items, $count, $perPage);
        return $pagination;
    }

    public function check() {
#        var_dump($this->all());
#        return $this;
        foreach($this->all() as $v) {
#            var_dump($v);
            $v->s = 'xxxxxxxxs';
        }

        var_dump($this->all());
    }

    public function addDistance($x, $y) {
        $coordBase = \Geotools::coordinate([$x, $y]);
#        var_dump($coordBase);
        foreach($this->all() as $v) {
            if($v->geohash != '') {
                $decode = \Geotools::geohash()->decode($v->geohash);
                $distance = \Geotools::distance()->setFrom($coordBase)->setTo($decode->getCoordinate())->in('km')->flat();
                $v->distance = number_format($distance,2).'km';
#                var_dump($v->distance);
            } else {
                $v->distance = '>10km';
            }
        }
        return $this;
    }
    //默认>10Km 无地理位置请求
    public function addDistanceDefault() {
        foreach($this->all() as $v) {
            $v->distance = '>10km';
        }
        return $this;
    }
}
