<?php
namespace Controllers;


class ApiController extends BaseController {

    protected $input;

    public function __construct() {
        $this->input = \Input::all();
    }

    //登录
    public function getLogin() {
        $data = array_only($this->input, ['phone', 'password']);

        if (\Auth::attempt($data)) {
            return 1;
        }
        return 0;
    }

    public function getCode() {
        $phone = array_get($this->input, 'phone');
        $code = app('phonecode')->sendCode($phone);
        return $code;
    }



    public function products() {
        $products = app('Weile\Repositories\ProductRepositoryInterface');
        $product_list = $products->findAllPaginated(3);
        return $product_list;


    }

    public function category($id) {
        $id = intval($id);
        if($id <= 0) {
            $data =  \Category::roots()->get();
        }
        else {
            $data = \Category::find($id)->children()->get();
        }

        return $data->toJson();
    }





}
