<?php

namespace Weile\Services\Forms;

use Illuminate\Config\Repository;

class RegistrationForm extends AbstractForm
{
    /**
     * Config repository instance.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
            'invite_phone' => 'required|digits:11|exists:members,phone',
            'phone' => 'required|digits:11|unique:members',
            'username' => 'required|min:4|unique:members',
            'password' => 'required|min:6',
            'token' => 'required|digits:4',
        ];

    /**
     * Array of custom validation messages.
     *
     * @var array
     */
    // protected $messages = [
    //         'invite_phone.exists' => '邀请人手机号码不存在',
    //         'phone.unique' => '手机号码已注册',
    //         'username.unique' => '用户名已被注册',
    //     ];

    /**
     * Create a new RegistrationForm instance.
     *
     * @param  \Illuminate\Config\Repository  $config
     * @return void
     */
    public function __construct(Repository $config)
    {
        parent::__construct();

        $this->config = $config;
    }

    /**
     * Get the prepared validation rules.
     *
     * @return array
     */
    protected function getPreparedRules()
    {
        $forbidden = $this->config->get('config.forbidden_usernames');
        $forbidden = implode(',', $forbidden);

        $this->rules['username'] .= '|not_in:' . $forbidden;

        return $this->rules;
    }
}
