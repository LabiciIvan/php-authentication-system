<?php
require __DIR__ . "/classes/TemporaryStorage.php";

use Classes\TemporaryStorage;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['route']) && ($_POST['route'] === 'login' || $_POST['route'] === 'register')) {

	if ($_POST['route'] === 'login') {
		// Pick the data from request and pass to loginRoute function.
		$login_data = [
			'email'		=> $_POST['email'],
			'password'	=> $_POST['password'],
		];

		loginRoute($login_data);
	}

}


/**
 * This function is responsible with handling the login route.
 * 
 * It will call the necessary classes and methods to execute
 * a login process.
 */
function loginRoute(array $login_data) {

	TemporaryStorage::sessionStart();
	$tempStorage = new TemporaryStorage($login_data, 'login');
	$tempStorage->store();
}
?>