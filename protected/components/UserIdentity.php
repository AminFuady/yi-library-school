<?php
class UserIdentity extends CUserIdentity
{
	const ERROR_USER_BANNED = -1;
	const ERROR_USER_NEED_TO_ACTIVATED = -5;
	/** @var integer */
	private $id;

	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		/** @var User $user */
		$user = User::model()->find('email=:email', array(':email' => $this->username));
		
		if ($user === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else if ($user->password !== User::hashPassword($this->password)) {
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}else if($user->status == User::STATUS_DISABLE){
			$this->errorCode = self::ERROR_USER_BANNED;
			return $this->errorCode;
		} else {
			$this->id		= $user->id;
			$this->username	= $user->name;
			$this->errorCode= self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
}