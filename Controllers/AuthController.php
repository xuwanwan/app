<?php

namespace Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Weile\Repositories\MemberRepositoryInterface;

class AuthController extends BaseController
{
    protected $users;

    public function __construct(MemberRepositoryInterface $member)
    {
        parent::__construct();

        $this->users = $member;
    }


    public function getLogin()
    {
        if(Auth::check()) {
            return \Redirect::to('member');
        }

        $this->view('member.login');
    }


    public function postLogin()
    {
        $credentials = Input::only([ 'phone', 'password' ]);
        $remember    = Input::get('remember', false);

        if (Auth::attempt($credentials, $remember)) {
            //app端应该返回成功数据
            return \Redirect::to('member');
#           return $this->redirectIntended(route('user.index'));
        }
        else {

            return $this->redirectBack([ 'error' => 'username or password incorrect' ]);
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

    public function postCode() {
#        $data = array_only(Input::all(), 'phone');
        $rules = [
            'phone'=>'required|digits:11',
        ];
        $validator = \Validator::make(Input::all(),$rules);
        if($validator->passes()) {
            $phone = Input::get('phone');
            $code = app('phonecode')->sendCode($phone);
            return $code;
        }
        return 0;
#        return \Redirect::back()->withInput($data)->with();
    }

    /**
     * Post registration form.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister()
    {

        $form = $this->users->getRegistrationForm();

        if (! $form->isValid()) {
            return $this->redirectBack([ 'error' => $form->getErrors() ]);
        }
        //手机验证码
        $phonecode = app('phonecode');
        if (!$phonecode->validate(\Input::get('phone'), \Input::get('token'))) {
            return $this->redirectBack([ 'error' => 'phone code error']);
        }

        if ($user = $this->users->create($form->getInputData())) {
            Auth::login($user);

            return $this->redirectRoute('auth.login', [], [ 'first_use' => true ]);
        }

 #       return $this->redirectRoute('home');
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
