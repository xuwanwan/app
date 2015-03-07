<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 15/3/3
 * Time: 下午9:15
 */

namespace Controllers;

use Illuminate\Support\Facades\Input;

use Weile\Repositories\SellerRepositoryInterface;

class SellerController extends BaseController {
    protected $sellers;

    public function __construct(SellerRepositoryInterface $sellers) {
        parent::__construct();
        $this->beforeFilter('auth', ['only'=>'orderStored']);
        $this->sellers = $sellers;
    }
    public function index() {
        $data = $this->sellers->findAllPaginated(3);
#        var_dump($data->toArray());
        $this->view('sellers.index', compact('data'));
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
        //距离
        if (Input::has('l') && Input::get('l') > 0) {
            $q['l'] =  intval(Input::get('l'));
        }
        //x
        if (Input::has('x') && Input::get('x') > 0) {
            $q['x'] =  floatval(Input::get('x'));
        }
        //y
        if (Input::has('y') && Input::get('y') > 0) {
            $q['y'] =  floatval(Input::get('y'));
        }
        //type
        if (Input::has('t') && Input::get('t') > 0) {
            $q['t'] =  intval(Input::get('t'));
        }


        $sellers = $this->sellers->findByKeywordPaginated($q, 10);

#        var_dump(\DB::getQueryLog());
        $this->view('sellers.search',compact('q', 'sellers'));
    }

    public function show($id) {
        $seller = $this->sellers->findById($id);
#        var_dump($seller->cardstored);
        $this->view('sellers.show', compact('seller'));
    }

    public function detail($id) {
        $seller = $this->sellers->findById($id);
        //TODO 暂不处理距离
        $seller->distance = '>10km';
        $this->view('sellers.detail', compact('seller'));
    }

    public function cardStored($id) {
        $card = \CardStored::find($id);
#        var_dump($card);
        $this->view('sellers.cardstored',compact('card'));
    }
    public function orderStored($id) {
        $card = \CardStored::find($id);
#        var_dump($card);
        $card->discount = $card->origin_price - $card->price;
        $this->view('sellers.orderstored',compact('card'));
    }



    public function cardVip($id) {
        $card = \CardVip::find($id);
#        var_dump($card);
        $this->view('sellers.cardvip',compact('card'));
    }

    public function cardVoucher($id) {
        $card = \CardVoucher::find($id);
#        var_dump($card);
        $this->view('sellers.cardvoucher',compact('card'));
    }
    public function orderVoucher($id) {
        $card = \CardVoucher::find($id);
#        var_dump($card);
        $card->discount = $card->origin_price - $card->price;
        $this->view('sellers.ordervoucher',compact('card'));
    }
    public function cardCoupon($id) {
        $card = \CardCoupon::find($id);
#        var_dump($card);
        $this->view('sellers.cardcoupon',compact('card'));
    }
}
