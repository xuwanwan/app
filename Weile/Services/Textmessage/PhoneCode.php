<?php namespace Weile\Services\Textmessage;


use Illuminate\Support\Facades\DB;
use Weile\Services\Textmessage\MessageApi;
use RandomLib\Factory;
use Carbon\Carbon;



class PhoneCode {
	protected $sender;
	protected $db;
	protected $reminderView;
	protected $expires;


	public function __construct(PhoneMessage $sender, $reminderView, $expire) {
		$this->sender = $sender;
		$this->db = DB::table('password_reminders');
		$this->reminderView = $reminderView;
		$this->expires = $expire * 60;
	}


	public function sendCode($phone) {
		$token = $this->createNewToken();

		$this->db->insert($this->getPayload($phone, $token));

		$this->sendSms($token, $phone);
        return $token;
	}


	protected function sendSms($token, $to) {

		$view = $this->reminderView;

		return $this->sender->send($view, compact('token'), $to);
	}

	protected function getPayload($phone, $token){
		return array('phone' => $phone, 'token' => $token, 'created_at' => new Carbon);
	}

	public function validate($phone, $token) {

		$reminder = (array) $this->db->where('phone', $phone)->where('token', $token)->orderBy('created_at', 'desc')->first();

		if( $reminder && ! $this->reminderExpired($reminder) ) {
			$this->delete($phone);
			return true;
		}	
		return false;
	}

	public function delete($phone)
	{
		$this->db->where('phone', $phone)->delete();
	}	

	/**
	 * Determine if the reminder has expired.
	 *
	 * @param  array  $reminder
	 * @return bool
	 */
	protected function reminderExpired($reminder)
	{
		$createdPlusHour = strtotime($reminder['created_at']) + $this->expires;

		return $createdPlusHour < $this->getCurrentTime();
	}


	protected function createNewToken()
	{
		$factory = new Factory();
		$generator = $factory->getMediumStrengthGenerator();
		$value = $generator->generateString(4, '0123456789');

		return $value;
	}	

	protected function getCurrentTime()
	{
		return time();
	}	
}