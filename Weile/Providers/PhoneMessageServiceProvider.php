<?php
namespace Weile\Providers;

use Illuminate\Support\ServiceProvider;
use Weile\Services\Textmessage\MessageApi;
use Weile\Services\Textmessage\PhoneMessage;

class PhoneMessageServiceProvider extends ServiceProvider {

	protected $defer = true;

	public function register() {

		$me = $this;

		$this->app->bindShared('phonemessage', function($app) use ($me) {

			$me->registerMessageApi();

			$mailer = new PhoneMessage($app['view'], $app['messageapi']);
			$mailer->setLogger($app['log'])->setQueue($app['queue']);

			$pretend = $app['config']->get('mail.pretend', false);
#			$pretend = false;
			$mailer->pretend($pretend);

			return $mailer;
		});
		$this->registerMessageApi();
	}

	public function registerMessageApi() {
		$this->app['messageapi'] = $this->app->share(function($app){
			return new MessageApi();
		});
	}


	public function provides()
	{
		return array('messageapi', 'phonemessage');
	}
}