<?php

class UserIdentity extends CUserIdentity
{
	protected $_id;

	public function authenticate()
	{
		$user = User::model()->findByAttributes(
			array(
				'mail' => $this->username,
				'password' => crypt($this->password, User::SALT)
			)
		);
		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else {
			if ($user->status == 1) {
				$this->_id = $user->id;
				$this->username = $user->mail;
				$this->errorCode = self::ERROR_NONE;
			} else {
				$this->errorCode = self::ERROR_USERNAME_INVALID;
			}
		}

		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}
