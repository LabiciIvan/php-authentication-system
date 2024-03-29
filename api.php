<?php

require __DIR__ . "/classes/Validation.php";
require __DIR__ . "/classes/TemporaryStorage.php";
require __DIR__ . "/classes/Base/AuthenticationBase.php";

use Classes\Validation;
use Classes\TemporaryStorage;
use Classes\Base\AuthenticationBase;

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

	// Helps with all authentication processes.
	$auth = new AuthenticationBase($login_data);

	// If user not logged then will log the user in.
	if(!$auth->checkIfLogged()) {
		// Perform the user log-in.
		$auth->login();
	}
}

/**
 * This function is responsible with handling the register route.
 * 
 * It will call the necessary classes and methods to execute
 * a register process.
 */
function registerRoute(array $register_data) {
	
	// Rules to register data.
	$register_rules = [
		'name'				=> 'required|min:4',
		'gender'			=> 'required',
		'email'				=> 'required|isEmail',
		'password'			=> 'required|repeat|min:4',
		'password_repeat'	=> 'required|min:4',
	];

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
	$validator = new Validation($register_data, $register_rules);
	$validator->validate();
	$validation_errors = $validator->getError();

	// If any errors are found after validation redirect to register page.
	if (isset($validation_errors)) {
		// Store the errors in session.
		$tempErrors = new TemporaryStorage($validation_errors, 'register_errors');
		$tempErrors->store();
		header("location: register");
		exit;
	}

	// Validation logic finished and we can store the user in database.
	$auth = new AuthenticationBase($register_data);

	// Check if user is already registered in the database.
	if ($auth->checkUserExists()) {
		$user_exists_error = new TemporaryStorage(['email' => ['Email is already in use.']], 'register_errors');
		$user_exists_error->store();
		header("location: register");
	}

	// If registration is successful, then remove all errors and redirect
	// with a success message.
	if ($auth->registerUser()) {
		// Remove session data related to errors and register data.
		unset($_SESSION['register_errors']);
		unset($_SESSION['register']);

		// Store a new session with a message to user and return to register page.
		$register_success = new TemporaryStorage(['success' => 'Registered with success.'], 'register_success');
		$register_success->store();
	
		header("location: register");
	}
}
?>