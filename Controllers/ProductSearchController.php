<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/26
 * Time: 下午5:51
 */

namespace Controllers;

use Input;

use Weile\Repositories\ProductRepositoryInterface;

class ProductSearchController extends BaseController {
    protected $products;

    public function __construct(ProductRepositoryInterface $products) {
        parent::__construct();
        $this->products = $products;
    }
    public function search() {
//        $q = e(\Input::get('q'));
        $q = [];

        //key
        if (Input::has('q')) {
            $q['q'] =  e(Input::get('q'));
        }
        //category
        if (Input::has('c') && Input::get('c') > 0) {
            $q['c'] =  intval(Input::get('c'));
        }
        //district
        if (Input::has('d') && Input::get('d') > 0) {
            $q['d'] =  intval(Input::get('d'));
        }
        //type
        if (Input::has('t') && Input::get('t') > 0) {
            $q['t'] =  intval(Input::get('t'));
        }


        $products = $this->products->findByKeywordPaginated($q, 3);

        var_dump(\DB::getQueryLog());
        $this->view('products.search',compact('q', 'products'));
    }
}
