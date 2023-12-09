<?php

namespace Classes\Interface;

/**
 * Interface which dictates to {@link RegisterBase} class the
 * required methods to register users into the database.
 * 
 * This interface is only specific to this simple application.
 * 
 * The {@link RegisterBase} class implements this interface.
 */
Interface RegisterInterface {

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
	public function registerUser(): int;
}

?>