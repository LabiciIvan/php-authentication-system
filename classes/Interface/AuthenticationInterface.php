<?php

namespace Classes\Interface;

/**
 * Authentication Interface.
 * 
 * This interface dictates required methods and processes
 * to execute the log-in, log-out or registration of a user.
 * 
 * This Interface can be used as a single class which will be
 * used for both purpouses : registration and log-in.
 */
Interface AuthenticationInterface {

	/**
	 * Check user exists.
	 * 
	 * It checks if the users exists in the database
	 * by using the email address.
	 * 
	 * Uses the email address to find a match record, and
	 * will return true if it finds and false otherwise.
	 * 
	 * @return bool
	 */
	public function checkUserExists(): bool;

	/**
	 * Register user.
	 * 
	 * It registers the uses in to the database using the details
	 * provided when instantiating a new class instance.
	 * 
	 * Will return the id of the inserted row.
	 * 
	 * @return int
	 */
	public function registerUser(): bool;

	/**
	 * Get user.
	 * 
	 * Return the user name from database for the passed in ID.
	 * 
	 * This method is used when we registered an user in database and we
	 * want to fetch that user based on the last insert ID.
	 * 
	 * @param	int		$id		The user ID from database.
	 * @return mixed			The fetched user from database.
	 */
	public function getUser(int $id): mixed;

	/**
	 * Log in.
	 * 
	 * This method will log the user in to the session.
	 * 
	 * It checks the required field to be present for a
	 * complete log in.
	 */
	public function login(): mixed;


	/**
	 * Log out.
	 * 
	 * Logs out the user from the current session.
	 */
	public function logOut(): mixed;

}