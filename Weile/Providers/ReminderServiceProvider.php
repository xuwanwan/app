<?php
namespace Weile\Providers;

use Illuminate\Support\ServiceProvider;
use Weile\Services\Textmessage\PasswordBroker;
use Weile\Services\Textmessage\DatabaseReminderRepository as DbRepository;

class ReminderServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerPasswordBroker();

		$this->registerReminderRepository();

	}

	/**
	 * Register the password broker instance.
	 *
	 * @return void
	 */
	protected function registerPasswordBroker()
	{
		$this->app->bindShared('phone.reminder', function($app)
		{
			// The reminder repository is responsible for storing the user e-mail addresses
			// and password reset tokens. It will be used to verify the tokens are valid
			// for the given e-mail addresses. We will resolve an implementation here.
			$reminders = $app['phone.reminder.repository'];

			$users = $app['auth']->driver()->getProvider();

			$view = $app['config']['config.reminder.phone'];

			// The password broker uses the reminder repository to validate tokens and send
			// reminder e-mails, as well as validating that password reset process as an
			// aggregate service of sorts providing a convenient interface for resets.
			return new PasswordBroker(

				$reminders, $users, $app['phonemessage'], $view

			);
		});
	}

	/**
	 * Register the reminder repository implementation.
	 *
	 * @return void
	 */
	protected function registerReminderRepository()
	{
		$this->app->bindShared('phone.reminder.repository', function($app)
		{
			$connection = $app['db']->connection();

			// The database reminder repository is an implementation of the reminder repo
			// interface, and is responsible for the actual storing of auth tokens and
			// their e-mail addresses. We will inject this table and hash key to it.
			$table = $app['config']['auth.reminder.table'];

			$key = $app['config']['app.key'];

			$expire = $app['config']->get('config.reminder.phoneexpire', 10);

			return new DbRepository($connection, $table, $key, $expire);
		});
	}



	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
#		return [];
		return array('phone.reminder', 'phone.reminder.repository');
	}

}
