<?php

class Auth extends CUserIdentity
{
	protected $_user;

	public function __construct($user)
	{
		$this->_user = $user;
		$this->authenticate();
	}

	public function authenticate()
	{
		$this->username = $this->_user->mail;
		$this->errorCode = self::ERROR_NONE;

		return true;
	}

	public function getId()
	{
		return $this->_user->id;
	}
}
