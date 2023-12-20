<?php

namespace Classes\Interface;

/**
 * This interface is a guide to the base class.
 * 
 * Base class will have to implement all methods
 * requested by the interface.
 * 
 * Shows which methods are required to the execute
 * login processes.
 */
Interface LoginInterface {

	/**
	 * Log in.
	 * 
	 * Will log in the user in the system.
	 */
	public function login(): mixed;

	/**
	 * Get user.
	 * 
	 * This method will get the user from the database.
	 */
	public function getUser(): mixed;


	/**
	 * Log out.
	 * 
	 * Will log out the currently loged in user.
	 */
	public function logOut(): mixed;
}

?>