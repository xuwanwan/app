<?php

namespace Controllers;

use ImageUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Weile\Repositories\MemberRepositoryInterface;
use Weile\Repositories\BaseDataRepositoryInterface;


class MembersController extends BaseController {

    //当前用户
    protected $member;

    //用户模型
    protected $members;

    protected $basedata;


    public function __construct(MemberRepositoryInterface $members, BaseDataRepositoryInterface $basedata)
    {
        parent::__construct();

        $this->beforeFilter('auth');

        $this->member   = Auth::user();
        $this->members  = $members;
        $this->basedata = $basedata;
    }

    public function getIndex()
    {
        $data_array = $this->member->toArray();
        $keys_except = ['login', 'created_at', 'updated_at', 'last_attempt_at'];
        $res = array_except($data_array, $keys_except);
        var_dump($res);
    }


    public function avatar() {
        $this->view('member.avatar');
    }

    public function postAvatar() {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            ImageUpload::enableCORS($_SERVER['HTTP_ORIGIN']);
        }

        if (Request::server('REQUEST_METHOD') == 'OPTIONS') {
            exit;
        }

        $json = ImageUpload::handle(Input::file('avatar'));

        if ($json !== false) {

            //储存图像字段至数据库
            $this->member->photo = $json['images']['relativefile'];
            $this->member->save();
            return Response::json($json, 200);

        }

        return Response::json('error', 400);
    }

    public function detail() {
        $form_data = $this->basedata->getMemberDetailFormOptions();

        $member_detail = $this->member->detail;

        if ($member_detail) {
            if (\Input::has('api')) {
                return $member_detail->toArray();
            }
            $this->view('member.detail-edit', compact('member_detail','form_data'));
        } else {
            if (\Input::has('api')) {
                return 'false';
            }
            $this->view('member.detail-new', $form_data);
        }

    }


    public function postDetail() {
        //更新用户名
        $username = Input::get('username');
        if(! $this->members->updateUserName($this->member, $username)) {
            echo 'name is not allow';
            return;
        }
        //更新其它字段

        $form = $this->members->getDetailForm();
        if (!$form->isValid()) {
            return $this->redirectBack(['errors'=> $form->getErrors()]);
        }

        $this->members->updateDetail($this->member, Input::all());
        return 'success!';
    }


    public function password() {
        $this->view('member.password');
    }

    public function postPassword() {
        $rules = [
            'password' => 'required|confirmed|min:6'
        ];

        $validator = \Validator::make(\Input::all(), $rules);

        if (!$validator->passes()) {
            return $this->redirectBack(['errors' => $validator->errors()]);
        }
        $this->member->password = \Input::get('password');
        $this->member->save();
        return 'success';

    }






}