<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUser;

class User extends SentryUser {

	public function save(array $options = array())
	{
#		return forward_static_call(array('Illuminate\Database\Eloquent\Model', 'save'), $options);
		$id = \Input::get('id');
#		var_dump($id);exit;
		if ($id > 0) {	//编辑
			return forward_static_call(array('Illuminate\Database\Eloquent\Model', 'save'), $options);
		} else { //新建
			parent::save($options);
			$user = \Sentry::findUserById($this->id);
			$user->attemptActivation($user->getActivationCode());
		}
	}

}