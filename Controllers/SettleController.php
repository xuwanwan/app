<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/28
 * Time: 下午2:03
 */

namespace Controllers;

use Weile\OrderedTreeDistrict;
use Weile\Repositories\MemberRepositoryInterface;

class SettleController extends BaseController {

    protected $members;
    protected $member;

    public function __construct(MemberRepositoryInterface $members) {

        $this->beforeFilter('auth');

        $this->members = $members;
        $this->member = \Auth::user();

        parent::__construct();
    }

    //结算
    public function settle() {
        //查询默认收货地址
        $delivery = $this->member->deliveryDefault;

        $products = \Cart::content();
        $freight = number_format($products->getFreight(), 2);
        $total = number_format(\Cart::total() + $freight, 2);


        $delivery->district_path = OrderedTreeDistrict::getPathById($delivery->district);

#        var_dump(\Cart::content()->getFreight());
#        var_dump(\DB::getQueryLog());

        $this->view('settle.index', compact('delivery', 'products', 'total', 'freight'));
    }

    //订单生成
    public function makeOrder() {
        //订单生成,
        $fileds = ['amount', 'freight', 'username', 'phone', 'district', 'district_detail'];
        $data = array_only(\Input::all(), $fileds);
        $data = array_add($data, 'member_id', $this->member->id);
        $data = array_add($data, 'order_id', build_order_no());

#        var_dump($data);
        //绑定产品与订单的关联
        $products = \Cart::content();
        if($products->count()) {
            $products_id = [];
            foreach ($products as $row) {
#            echo $row->id;
                $products_id[$row->id] = ['num'=>$row->qty];
            }
#var_dump($products_id);exit;

            $product_order = new \ProductOrder($data);
            $product_order->save();
            $product_order->products()->sync($products_id);

            \Cart::destroy();

            return \Redirect::back()->with(['success' => 'success!']);
        }
        return \Redirect::back()->with(['error' => 'none items!']);
    }
}