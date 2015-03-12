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
            return \Auth::user();
#            return 1;
        }
        return 0;
    }

    public function getCode() {
        $phone = array_get($this->input, 'phone');
        $code = app('phonecode')->sendCode($phone);
        if($code) {
            return $code;
        }
        else {
            return 0;
        }
    }

    public function getRegister() {
        $return = [];
        $rules = [
            'invite_phone' => 'required|digits:11|exists:members,phone',
            'phone' => 'required|digits:11|unique:members',
            'username' => 'required|min:4|unique:members',
            'password' => 'required|min:6',
            'token' => 'required|digits:4',
        ];
        $validator = \Validator::make(\Input::all(), $rules);
        if($validator->fails()) {
            $return['type'] = 0;
            $return['msg'] = $validator->messages();
            return $return;
        }

        //手机验证码
        $phonecode = app('phonecode');

        if (!$phonecode->validate(\Input::get('phone'), \Input::get('token'))) {
            $return['type'] = 0;
            $return['msg'] = '验证码错误！';
            return $return;
        }

        $m = app('Weile\Repositories\MemberRepositoryInterface');
        if ($user = $m->create(\Input::all())) {
            $return['type'] = 1;
            $return['msg'] = '注册成功！';
            return $return;
        }
        return $return;
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
