<?php

namespace Classes;

require __DIR__ . "/Base/RegisterBase.php";

use Classes\Base\RegisterBase;

/**
 * Register users.
 * 
 * This class extend the {@link RegisterBase} class and
 * uses all the parent class methods to execute register
 * actions.
 * 
 * For more information look into {@link RegisterBase} class.
 */
class Register extends RegisterBase {

	public function __construct($data)
	{
		parent::__construct($data);
	}

	/**
	 * Checks if user exists in the database.
	 * 
	 * It uses the parent method to execute the action and
	 * return only the result which is a true if exists and
	 * false otherwise.
	 * 
	 * @return	bool	True if exists False otherwise
	 */
	public function checkUserExists():bool {
		$result = parent::checkUserExists();
		return $result;
	}

	/**
	 * Registers user.
	 * 
	 * Registers user in the databse and uses the parent method
	 * to execute the action and will only return the result
	 * which will be the ID of the inserted row.
	 * 
	 * @return	int		Inserted row ID.
	 */
	public function registerUser():int {
		$lastId = parent::registerUser();
		return $lastId;
	}

	/**
	 * Get user.
	 * 
	 * Get the user from databse.
	 * 
	 * It uses the $id as parameter to fetch the user.
	 * 
	 * @param	int		$id		Id of a user from database.
	 * @return	mixed			The fetched user from database.
	 */
	public function getUser($id): mixed {
		$user = parent::getUser($id);
		return $user;
	}
	
}


?>