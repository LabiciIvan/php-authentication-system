<?php
require "./classes/TemporaryStorage.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST)) {

	$login_data = [
		'email'		=> $_POST['email'],
		'password'	=> $_POST['password'],
	];

	TemporaryStorage::sessionStart();
	$tempStorage = new TemporaryStorage($login_data, 'login');
	$tempStorage->store();
}

?>