<?php

namespace Weile\Repositories\Eloquent;

use Weile\Member;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


use Weile\MemberDelivery;
use Weile\Services\Forms\SettingsForm;
use Weile\Services\Forms\RegistrationForm;
use Weile\Exceptions\MemberNotFoundException;
use Weile\Repositories\MemberRepositoryInterface;

class MemberRepository extends AbstractRepository implements MemberRepositoryInterface
{
    public function __construct(Member $member)
    {
        $this->model = $member;
    }

    public function findAllPaginated($perPage = 200)
    {
        return $this->model
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage);
    }

    public function findByUsername($username)
    {
        return $this->model->whereUsername($username)->first();
    }

    public function findByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }

    public function findByPhone($phone)
    {
        return $this->model->wherePhone($phone)->first();
    }

    public function findById($id)
    {
        return $this->model->whereId($id)->first();
    }


    public function requireByUsername($username)
    {
        if (! is_null($user = $this->findByUsername($username))) {
            return $user;
        }

        throw new UserNotFoundException('The user "' . $username . '" does not exist!');
    }

    public function create(array $data)
    {
        $member = $this->getNew();

        $member->phone = $data['phone'];
        $member->username = $data['username'];
        $member->password = $data['password'];
        $member->save();

        //处理关联粉丝
        $invite_member = $this->findByPhone($data['invite_phone']);
        $member->addFriend($invite_member);

        //增加粉丝数
        $this->incrementFansCount($member->id);        

        return $member;
    }

    protected function incrementFansCount($id) {
        $current_id = $id;
        $i = 0;
        while ($friend = $this->findById($current_id)->friends->first()) {
            if ($i == 0) {
               $friend->increment('fans_direct');
            } elseif ($i > 0) {
               $friend->increment('fans_related');
            }
            $i++;
            $current_id = $friend->id;
        }
    }

    //获取上级元素，限制层级 上5级limit为4.
    public function getAncestors($id,$limit) {
        $current_id = $id;
        $i = 0;
        $return = [];
        while ($friend = $this->findById($current_id)->friends->first()) {
            if ($i <= $limit) {
                $return[] = ['id'=>$friend->id, 'type'=>$friend->type];
#                $return[$friend->id] = $friend->type;
            } else {
                break;
            }
            $i++;
            $current_id = $friend->id;
        }
        return $return;
    }

    public function getDescendants($id) {
        $return = $this->findById($id)->reverseFriends()->get();
        return $return;
    }

    //计算某一用户的上级用户分利
    public function addProfit($id, $profit) {
        //昨日收益增加，收益总额增加、余额增加
#        $member = $this->findById($id);
        //获取某一ID的上级元素
        $res = $this->getAncestors($id,4);
        $res = array_reverse($res);
#        var_dump($res);
        $root = head($res);
#        var_dump($root);
        //说明已经到代理商了，需要按代理商的比例分利
        $percent_row = \ProfitPercent::first();
#        $profit = 88.88;
        //默认提点计算
        $profit_split = income_mul($profit, percent_div($percent_row->base));
#        $profit_split = $profit*($percent_row->base/100);
#        echo $profit_split;
        if($root['type'] > 0 && $root['type'] != 4) {
#            echo '省市代理';
            //省市门店提点计算
            foreach ($res as $v) {
                $percent = 0;
                switch ($v['type']) {
                    //省级代理
                    case 1:
                        $percent = $percent_row->province;
                        break;
                    //市级代理
                    case 2:
                        $percent = $percent_row->city;
                        break;
                    //门店代理
                    case 3:
                        $percent = $percent_row->store;
                        break;
                    //普通用户
                    default:
                        $percent = $percent_row->member;
                        break;
                }
                //比率X利润加到用户余额里
                $percent = percent_div($percent);
                $val = 0;
                $val = income_mul($profit_split, $percent);
#                echo $val;
                $this->countProfit($v['id'], $val, $percent);
#                echo $percent,'--', $v['id'], '--',$v['type'],'<br/>';
            }
        } elseif($root['type'] == 4) { //公司代理
#            echo '公司代理';
            $left = array_slice($res, 1);
            $percent = 0;
            $percent = $percent_row->member;
            //公司比例为基础比例-余下用户数分成比率
            $company_percent = $percent_row->base - (count($left)*$percent);
            $val = 0;
            $val = income_mul($profit_split, percent_div($company_percent));
            $this->countProfit($root['id'], $val, $company_percent);
#            echo $val;
#            echo $company_percent, '--',$root['id'], '--',$root['type'],'<br/>';
#            var_dump($company_percent);

            foreach($left as $v) {
                //添加分利

                $val = 0;
                $val = income_mul($profit_split, percent_div($percent));
#                echo $val;
                $this->countProfit($v['id'], $val, $percent);
#                echo $percent, '--',$v['id'], '--',$v['type'],'<br/>';
            }

        } else { //普通用户，则按用户比例分利，且只分两级
#            echo '普通用户';
            $valid_user = array_slice($res,-2);
            $percent = 0;
            $percent = $percent_row->member;
            foreach($valid_user as $v) {
                //添加分利
                $val = 0;
                $val = income_mul($profit_split, percent_div($percent));
                $this->countProfit($v['id'], $val, $percent);
#                echo $val;
#                echo $percent, '--',$v['id'], '--',$v['type'],'<br/>';
            }
        }
    }

    public function countProfit($id, $value, $percent) {
        $member = $this->findById($id);
        $member->income_yesterday = income_add($member->income_yesterday, $value);
        $member->income_total = income_add($member->income_total, $value);
        $member->balance = income_add($member->balance, $value);
        $member->save();
        $message = "下线订单分利提成（".$value."*".$percent."%）";
        \Event::fire('paylog', [$member,$message,"+$value"]);
    }


    protected function usernameIsAllowed($username)
    {
        return ! in_array(strtolower($username), Config::get('config.forbidden_usernames'));
    }

    //银行卡
    public function createBankcard(Member $member,array $data) {
        $fields = array_only($data, ['username', 'card_number', 'bank_id', 'district', 'district_detail']);
        $de = new \Weile\MemberBankcard($fields);
        $member->bankcard()->save($de);
    }
    public function updateBankcard(Member $member, $id,array $data) {
        $fields = array_only($data, ['username', 'card_number', 'bank_id', 'district', 'district_detail']);
        $member->bankcard()->where('id', '=', $id)->update($fields);
    }
    //end

    //收货地址
    public function createDelivery(Member $member,array $data) {
        $fields = array_only($data, ['username', 'phone', 'postalcode', 'district', 'detail']);
        $de = new MemberDelivery($fields);
        $member->delivery()->save($de);
    }

    public function updateDelivery(Member $member, $id,array $data) {
        $fields = array_only($data, ['username', 'phone', 'postalcode', 'district', 'detail']);
        $member->delivery()->where('id', '=', $id)->update($fields);
    }
    //end


    public function getRegistrationForm()
    {
        return app('Weile\Services\Forms\RegistrationForm');
    }

    public function getMemberDeliveryForm() {
        return app('Weile\Services\Forms\MemberDeliveryForm');
    }

    public function getMemberBankcardForm() {
        return app('Weile\Services\Forms\MemberBankcardForm');
    }
}
