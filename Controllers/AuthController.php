<?php

namespace Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Weile\Repositories\MemberRepositoryInterface;

class AuthController extends BaseController
{
    /**
     * User Repository.
     *
     * @var \Tricks\Repositories\UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new AuthController instance.
     *
     * @param  \Tricks\Repositories\UserRepositoryInterface $users
     * @return void
     */
    public function __construct(MemberRepositoryInterface $member)
    {
        parent::__construct();

        $this->users = $member;
    }


    public function getLogin()
    {
        if(Auth::check()) {
            var_dump(Auth::user());
            exit;
        }

        $this->view('member.login');
    }


    public function postLogin()
    {
        $credentials = Input::only([ 'phone', 'password' ]);
        $remember    = Input::get('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            //app端应该返回成功数据
            echo 'success';
#           return $this->redirectIntended(route('user.index'));
        }
        else {

            return $this->redirectBack([ 'login_errors' => true ]);
        }
    }

    /**
     * Show registration form.
     *
     * @return \Response
     */
    public function getRegister()
    {
        $this->view('member.register');
    }

    public function getCode($phone) {
        app('phonecode')->sendCode($phone);
    }

    /**
     * Post registration form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister()
    {
        //手机验证码
        $phonecode = app('phonecode');
        if (!$phonecode->validate(\Input::get('phone'), \Input::get('token'))) {
            return 'phone code invalid';
        }

        $form = $this->users->getRegistrationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'errors' => $form->getErrors() ]);
        }

        if ($user = $this->users->create($form->getInputData())) {
            Auth::login($user);

            return $this->redirectRoute('auth.login', [], [ 'first_use' => true ]);
        }

 #       return $this->redirectRoute('home');
    }

    /**
     * Handle Github login.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLoginWithGithub()
    {
        if (! Input::has('code')) {
            Session::keep([ 'url' ]);
            GithubProvider::authorize();
        } else {
            try {
                $user = Github::register(Input::get('code'));
                Auth::login($user);

                if (Session::get('password_required')) {
                    return $this->redirectRoute('user.settings', [], [
                        'update_password' => true
                    ]);
                }

                return $this->redirectIntended(route('user.index'));
            } catch (GithubEmailNotVerifiedException $e) {
                return $this->redirectRoute('auth.register', [
                    'github_email_not_verified' => true
                ]);
            }
        }
    }

    /**
     * Logout the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::logout();

        return $this->redirectRoute('auth.login', [], [ 'logout_message' => true ]);
    }
}
