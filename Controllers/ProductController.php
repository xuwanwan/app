<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/26
 * Time: 下午4:43
 */

namespace Controllers;


use Weile\Repositories\ProductRepositoryInterface;

class ProductController extends BaseController {
    protected $products;

    public function __construct(ProductRepositoryInterface $products) {
        parent::__construct();
        $this->products = $products;
    }
    public function index() {
        $products = $this->products->findAllPaginated(3);
        $this->view('products.index', compact('products'));
    }

    public function search() {

    }
}