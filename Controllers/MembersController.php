<?php

namespace Controllers;

use ImageUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Weile\Repositories\MemberRepositoryInterface;


class MembersController extends BaseController {

	//当前用户
	protected $member;

	//用户模型
	protected $members;


    public function __construct(MemberRepositoryInterface $members)
    {
        parent::__construct();

        $this->beforeFilter('auth');

        $this->member   = Auth::user();
        $this->members  = $members;
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
    	$this->view('member.detail');
    }


}