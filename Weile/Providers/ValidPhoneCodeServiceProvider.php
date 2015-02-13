<?php
namespace Weile\Providers;

use Illuminate\Support\ServiceProvider;
use Weile\Services\Textmessage\PhoneCode;

class ValidPhoneCodeServiceProvider extends ServiceProvider {

	protected $defer = true;


	public function register() {
		$this->app->bindShared('phonecode', function($app){
			$view = 'emails.auth.registercode';
			$sender = $app['phonemessage'];
			$expire = $app['config']->get('auth.reminder.phoneexpire', 10);

			return new PhoneCode($sender, $view, $expire);
		});
	}


	public function provides()
	{
		return array('phonecode');
	}	
}