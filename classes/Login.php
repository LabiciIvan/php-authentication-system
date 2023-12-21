<?php

namespace Classes;

include __DIR__ . "/Base/LoginBase.php";

use Classes\Base\LoginBase;

/**
 * Log in the user.
 * 
 * This class is an abstraction layer from the {@link @LoginBase}
 * 
 * It will inherit all the methods from the parent class to
 * execute the login and logout the user.
 */
class Login extends LoginBase {

	public function __construct($data) {
		parent::__construct($data);
	}
}