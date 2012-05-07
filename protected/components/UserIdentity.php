<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
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
// 		$users=array(
// 			// username => password
// 			'demo'=>'demo',
// 			'admin'=>'admin',
// 		);
		$user_model=Users::model()->findByAttributes(array('emailaddress'=>$this->username,'is_active'=>'Y'));
// 		echo "<pre>";
// 		print_r($user_model->attributes);
// 		exit;
		

		if(!isset($user_model->emailaddress))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($user_model->password!==md5($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->errorCode=self::ERROR_NONE;
			$this->setState('username', $user->emailaddress);
			$this->setState('userid', $user->userid);
		}
		return !$this->errorCode;
	}
}