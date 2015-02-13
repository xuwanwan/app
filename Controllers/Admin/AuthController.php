<?php

namespace Controllers\Admin;

use Controllers\BaseController;
use Sentry;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


class AuthController extends BaseController
{


    public function __construct()
    {
        parent::__construct();

    }

	public function getLogin() {

		$this->view('admin.login');
	}

	public function postLogin() {

        $remember = Input::get('rememberMe');

        $input = Input::only(array('email', 'password'));

        try {
        	Sentry::authenticate($input, $remember);
        	return Redirect::to('/admins');
        }
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    echo 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    echo 'User is not activated.';
		}

		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    echo 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    echo 'User is banned.';
		}        

	}

	public function getLogout() {
		Sentry::logout();
		return Redirect::route('admin.login');
	}
}
