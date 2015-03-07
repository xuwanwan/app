<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/2/28
 * Time: 下午2:03
 */

namespace Controllers;

use Weile\MemberCardCoupon;
use Weile\MemberCardVip;
use Weile\OrderedTreeDistrict;
use Weile\Repositories\MemberRepositoryInterface;

class SettleController extends BaseController {

    protected $members;
    protected $member;
    protected $generator;

    public function __construct(MemberRepositoryInterface $members) {

        parent::__construct();

        $this->beforeFilter('auth');

        $this->members = $members;
        $this->member = \Auth::user();

        $factory = new \RandomLib\Factory;
        $this->generator = $factory->getMediumStrengthGenerator();
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

    //储值卡订单生成
    public function makeOrderCardStored() {
#        var_dump(\Input::all());
        $data = array_only(\Input::all(), ['id', 'volume']);
#        var_dump($data);
        //创建订单
        $card = \CardStored::find($data['id']);
        $amount = bcmul($card->price, $data['volume'], 2);
        $order_id = build_order_no();
        $seller_id = $card->seller_id;
        $member_id = $this->member->id;
#        var_dump($order_id, $amount);


        $order = \CardOrder::create(['order_id'=>$order_id, 'amount'=>$amount, 'member_id'=>$member_id, 'seller_id'=>$seller_id]);
        $order->cardstoreds()->attach($data['id'],['num'=>$data['volume']]);

        return \Redirect::back()->with(['success' => 'success!']);
    }
    //代金券订单生成
    public function makeOrderCardVoucher() {
#        var_dump(\Input::all());
        $data = array_only(\Input::all(), ['id', 'volume']);
#        var_dump($data);
        //创建订单
        $card = \CardStored::find($data['id']);
        $amount = bcmul($card->price, $data['volume'], 2);
        $order_id = build_order_no();
        $seller_id = $card->seller_id;
        $member_id = $this->member->id;
#        var_dump($order_id, $amount);


        $order = \CardOrder::create(['order_id'=>$order_id, 'amount'=>$amount, 'member_id'=>$member_id, 'seller_id'=>$seller_id]);
        $order->cardvouchers()->attach($data['id'],['num'=>$data['volume']]);

        return \Redirect::back()->with(['success' => 'success!']);
    }

    //会员卡订单生成
    public function makeOrderCardVip() {
        if($this->member->cardsvip()->count()) {
            return \Redirect::back()->with(['success' => '已经领取!']);
        }

        $data = array_only(\Input::all(), ['id']);
#        var_dump($data);
        //创建订单
        $card = \CardVip::find($data['id']);
        $card->increment('sales_volume');
        $order_id = build_order_no();
        $seller_id = $card->seller_id;
        $member_id = $this->member->id;
#        var_dump($order_id, $amount);


        $order = \CardOrder::create(['order_id'=>$order_id,'member_id'=>$member_id, 'seller_id'=>$seller_id]);
        $order->cardvips()->attach($data['id'],['num'=>1]);

        //生成用户卡数据
        $membercard['card_id'] = $data['id'];
        $membercard['status'] = 1;
        $membercard['password'] = $this->generator->generateString(8, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->member->cardsvip()->save(new MemberCardVip($membercard));

        return \Redirect::back()->with(['success' => 'success!']);
    }
    //优惠券订单生成
    public function makeOrderCardCoupon() {
        if($this->member->cardscoupon()->count()) {
            return \Redirect::back()->with(['success' => '已经领取!']);
        }
        $data = array_only(\Input::all(), ['id']);
#        var_dump($data);
        //创建订单
        $card = \CardCoupon::find($data['id']);
        $card->increment('sales_volume');
        $order_id = build_order_no();
        $seller_id = $card->seller_id;
        $member_id = $this->member->id;
#        var_dump($order_id, $amount);


        $order = \CardOrder::create(['order_id'=>$order_id,'member_id'=>$member_id, 'seller_id'=>$seller_id]);
        $order->cardcoupons()->attach($data['id'],['num'=>1]);

        //生成用户卡数据
        $membercard['card_id'] = $data['id'];
        $membercard['status'] = 1;
        $membercard['password'] = $this->generator->generateString(8,'0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->member->cardscoupon()->save(new MemberCardCoupon($membercard));

        return \Redirect::back()->with(['success' => 'success!']);
    }
}