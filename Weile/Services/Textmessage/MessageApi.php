<?php namespace Weile\Services\Textmessage;

class MessageApi {

	protected $username = 'szironman';
	protected $password = 'wang23708593';


	public function __construct() {

	}

	public function send($message, $to) {

		return $this->send_sms($message, $to);
	}



	/**
	* 普通接口发短信
	* apikey 为云片分配的apikey
	* text 为短信内容
	* mobile 为接受短信的手机号
	*/
	public function send_sms($text, $mobile){
		$url="http://www.smsbao.com/sms";
		$data['u'] = $this->username;
		$data['p'] = md5($this->password);
		$data['m'] = $mobile;
		$data['c'] = $text;


		$query = http_build_query($data);
		return file_get_contents($url.'?'.$query);
	}	
}