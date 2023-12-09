<?php
require __DIR__ . "/classes/TemporaryStorage.php";
require __DIR__ . "/classes/Base/ValidationBase.php";

use Classes\TemporaryStorage;
use Classes\Base\ValidationBase;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['route']) && ($_POST['route'] === 'login' || $_POST['route'] === 'register')) {

	if ($_POST['route'] === 'login') {
		// Pick the data from request and pass to loginRoute function.
		$login_data = [
			'email'		=> $_POST['email'],
			'password'	=> $_POST['password'],
		];

		loginRoute($login_data);

	} else if ($_POST['route'] === 'register') {
		$register_data = [
			'name'				=> $_POST['name'],
			'gender'			=> $_POST['gender'],
			'email'				=> $_POST['email'],
			'password'			=> $_POST['password'],
			'password_repeat'	=> $_POST['password_repeat'],
		];

		registerRoute($register_data);
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

/**
 * This function is responsible with handling the register route.
 * 
 * It will call the necessary classes and methods to execute
 * a register process.
 */
function registerRoute(array $register_data) {

	// Start the session to store for temporary use incoming register data.
	TemporaryStorage::sessionStart();

	// Filter data into a new array only with non empty field values.
	// This will help to output the data in the form for the user.
	$register_received = array_filter($register_data, function($data) {
		return !empty($data);
	});

	// Store only data which is present in request and not empty fields.
	$tempRegisterData = new TemporaryStorage($register_received, 'register');
	$tempRegisterData->store();
	
	// Validate if all the fields have at least a value.
	$result = ValidationBase::checkExistance($register_data);

	// If is array then store in session the errors and redirect to register page.
	if (is_array($result)) {
		// Store the errors of fields which failed validation.
		$tempErrors = new TemporaryStorage($result, 'register_errors');
		$tempErrors->store();
		header("location: register");
		exit;
	}

}
?>