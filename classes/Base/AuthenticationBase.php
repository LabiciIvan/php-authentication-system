<?php

namespace Classes\Base;

require __DIR__ . "/../Interface/AuthenticationInterface.php";
require __DIR__ . "/../DB.php";

use Classes\Interface\AuthenticationInterface;
use Classes\DB;

class AuthenticationBase extends DB implements AuthenticationInterface {

	public function __construct() {
		// @TO DO
	}
}

?>