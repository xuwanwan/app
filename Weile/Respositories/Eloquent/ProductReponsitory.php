<?php

namespace Weile\Repositories\Eloquent;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


use Product;

use Weile\OrderedTreeDistrict;
use Weile\Repositories\ProductRepositoryInterface;


class ProductRepository extends AbstractRepository implements ProductRepositoryInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function findAllPaginated($perPage = 9) {
        $products = $this->model->orderBy('created_at', 'DESC')->paginate($perPage);
        return $products;
    }

    public function findMostRecent($perPage = 9) {
        return $this->findAllPaginated($perPage);
    }

    public function findByKeywordPaginated($q, $perPage = 9) {
        $model = $this->model;
        //keyword
        if (isset($q['q'])) {
            $keyword = $q['q'];
            $model = $model->where(function($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('detail', function ($query) use ($keyword) {
                        $query->where('detail', 'LIKE', '%' . $keyword . '%');
                    });
            });
        }
        //category
        if (isset($q['c'])) {
            $node = \Category::find($q['c']);
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
        if (isset($q['t'])) {
            switch ($q['t']) {
                case 1:
                    //综合排序
                    $model = $model->orderBy('rank', 'desc');
                    break;
                case 2:
                    //销量最高
                    $model = $model->orderBy('sales_volume', 'desc');
                    break;
                case 3:
                    //价格最低
                    $model = $model->orderBy('price', 'asc');
                    break;
                case 4:
                    //价格最高
                    $model = $model->orderBy('price', 'desc');
                    break;
                case 5:
                    //好评优先
                    $model = $model->orderBy('evaluation', 'desc');
                    break;
                case 6:
                    //最新发布
                    $model = $model->orderBy('created_at', 'desc');
                    break;
                default:
                    $model = $model->orderBy('created_at', 'desc');
                    break;
            }
        }


        $products = $model->paginate($perPage);
        return $products;
    }


}
