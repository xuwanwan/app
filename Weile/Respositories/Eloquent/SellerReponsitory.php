<?php

namespace Weile\Repositories\Eloquent;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


use Seller;

use Weile\OrderedTreeDistrict;
use Weile\Repositories\SellerRepositoryInterface;


class SellerRepository extends AbstractRepository implements SellerRepositoryInterface
{
    public function __construct(Seller $seller)
    {
        $this->model = $seller;
    }

    public function findAllPaginated($perPage = 9) {
        $products = $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
        return $products;
    }

    public function findMostRecent($perPage = 9) {
        return $this->findAllPaginated($perPage);
    }

    public function findById($id) {
        return $this->model->find($id);
    }

    public function findByKeywordPaginated($q, $perPage = 9) {
        $model = $this->model;
        //keyword
        if (isset($q['q'])) {
            $keyword = $q['q'];
            $model = $model->where(function($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
//                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
//                    ->orWhereHas('detail', function ($query) use ($keyword) {
//                        $query->where('detail', 'LIKE', '%' . $keyword . '%');
//                    });
            });
        }
        //category
        if (isset($q['c'])) {
            $node = \SellerCategory::find($q['c']);
            $sub = $node->getDescendantsAndSelf()->lists('id');
            $model = $model->whereIn('category', $sub);
        }
        //district
        //查询所有子元素
        if (isset($q['d'])) {
            $node = OrderedTreeDistrict::find($q['d']);
            $sub = $node->getDescendantsAndSelf()->lists('id');
            $model = $model->whereIn('district', $sub);
        }
        //type
        $distance = 0;
        if (isset($q['t'])) {
            switch ($q['t']) {
                case 1:
                    //离我最近
//                    $model = $model->orderBy('rank', 'desc');
                    //x,y
                    if(isset($q['x']) && isset($q['y'])) {
                        $coordToGeohash = \Geotools::coordinate([$q['x'],$q['y']]);
// encoding
                        $encoded = \Geotools::geohash()->encode($coordToGeohash, 6); // 12 is the default length / precision
// encoded
                        $geohash = $encoded->getGeohash();

#                        $model = $model->where('geohash', 'LIKE', '%'.$geohash);
                        $distance = 1;
                    }
                    break;
                case 2:
                    //评价最高
                    $model = $model->orderBy('evaluation', 'desc');
                    break;
                case 3:
                    //我最想要 TODO 暂不开发
                    $model = $model->orderBy('created_at', 'desc');
                    break;
                default:
                    $model = $model->orderBy('created_at', 'desc');
                    break;
            }
        }

        if(empty($q)) {
            $model = $model->orderBy('created_at', 'desc');
        }
#        $data = $data->paginate($perPage);

        //默认取1000条数据，需要对数据进行距离转换
        //加10分钟缓存
#        $model = $model->remember(10)->take(1000);
        $model = $model->take(1000);
#        $collection = $model->get()->addDistance($q['x'], $q['y'])
        //距离计算
        if($distance) {
            $collection = $model->get()->addDistance($q['x'], $q['y'])->orderBy('distance','asc');
        }
        else {
            $collection = $model->get()->addDistanceDefault();
        }
#        var_dump($collection);
#        $model->get()->check();

        $data = $collection->paginate($perPage);

#        var_dump($data);
        return $data;
    }


}
