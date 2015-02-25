<?php
namespace Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

use Symfony\Component\HttpFoundation\Response;

use Curl\Curl;

class ApiController extends BaseController {

    protected  $curl;

    public function __construct(Curl $curl) {
        $this->curl = $curl;

        $cookie_key = Config::get('session.cookie');
        $this->curl->setCookie($cookie_key, $_COOKIE[$cookie_key]);
        $this->curl->setOpt(CURLOPT_TIMEOUT, 1);

    }

    //数据输出
    public function getData() {
        /*
                $login = new \LoginReq();
                $login->setUname('1234');
                $login->setUpassword('11asdfs1');
                $packed = $login->serializeToString();
                die($packed);
        */
#		var_dump($this->curl);
    }

    public function getLogin() {

        $this->view('api.login');

    }

    public function postLogin() {
        if (\Auth::user()) {
            return $this->error('already login.');
        }

        //请求url
        $this->curl->post(\URL::route('auth.login'), \Input::all());


        //处理header
        $response_headers = $this->curl->response_headers;
        foreach ($response_headers as $v) {
            if (str_contains($v, ':')) {
                list($h_key, $h_val) = explode(':', $v, 2);
                $re_headers[$h_key] = trim($h_val);
            }
        }

#		var_dump($response_headers);
#		var_dump($re_headers);

        $data = '1';

        $response = Response::create($data, 200, $re_headers);

        $response->send();

    }

    public function getMemberDetail() {
        //请求url
        $this->curl->get(\URL::route('member.detail'), ['api'=>1]);
        echo $this->curl->response;
    }


    protected function error($msg) {
        echo $msg;
    }


    public function getLoginxxx() {


        $base_req = new \BaseReq();
        $packed = file_get_contents("php://input");

        $base_req->parseFromString($packed);

#		return $base_req;
        $resp = new \BaseResp();

        $cmd = new \ReqCmdid();
        $cmd_data = $cmd->getEnumValues();
        switch ($base_req->getReqCmdId()) {


            case $cmd_data['CMDID_LOGIN']:
                $resp->setResultMsg("login succ");
                $resp->setResultCode(1);

                $loginReq = new \loginReq();
                $loginReq->parseFromString($base_req->getReqData());
                // $loginReq->setUname("jesus");
                // $loginReq->setUpassword("jesus");
                $resp->setRespData($loginReq->serializeToString());
                break;

            default:
                $resp->setResultMsg('xxxx');
                break;
        }

        $packed = $resp->serializeToString();
        return $packed;
    }

}
