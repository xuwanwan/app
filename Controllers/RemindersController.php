<?php
namespace Controllers;
use Weile\Facades\Phone;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;




class RemindersController extends BaseController {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		$this->view('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		switch ($response = \Phone::remind(Input::only('phone')))
		{
			case Phone::INVALID_USER:
				return Redirect::back()->withInput()->with('error', Lang::get($response));

			case Phone::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	public function getReset()
	{
		$this->view('password.reset');
	}
	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'phone', 'password', 'password_confirmation', 'token'
		);

		$response = Phone::reset($credentials, function($user, $password)
		{
			$user->password = $password;

			$user->save();
		});

		switch ($response)
		{
			case Phone::INVALID_PASSWORD:
			case Phone::INVALID_TOKEN:
			case Phone::INVALID_USER:
				return Redirect::back()->with('error', '1');

			case Phone::PASSWORD_RESET:
				echo 'Success';
		}
	}

}
