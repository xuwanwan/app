<?php namespace Weile\Services\Textmessage;

trait RemindableTrait {

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderPhone()
	{
		return $this->phone;
	}

}
