<?php namespace Weile\Services\Textmessage;

interface RemindableInterface {

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderPhone();

}
