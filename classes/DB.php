<?php

namespace Classes;

include __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;

// Use the Dotenv to load the .env variables.
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

/**
 * Establish a connection to the database.
 * 
 * This method facilitates the establishment of a database
 * connection by utilizing the configuration variables stored
 * in the .env file.
 * 
 * It relies on the {@link PDO} class to manage database
 * connections and offers a rand of utility methods for 
 * querying the database.
 * 
 * @return	PDO		Instance of the PDO class
 */
class DB extends PDO {

	/**
	 * @param	string	$user	user name for the database.
	 */
	private ?string $user	= null;

	/**
	 * @param	string	$pwd	password for the database.
	 */
	private ?string $pwd	= null;

	/**
	 * Format for PDO connection.
	 * 
	 * Represents the following format for PDO to connect to databse e.g :
	 * 
	 * ======================================================================
	 *					"mysql:host=localhost;dbname=test"					
	 * ======================================================================
	 * 
	 * @param	string	$dhb	represents driver, host and database.
	 */
	private ?string $dhb	= null;

	public function __construct() {
		
		$this->dhb	= $_ENV['DB_DRIVER'] . ':host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'];
		$this->user	= $_ENV['DB_USER'];
		$this->pwd	= $_ENV['DB_PWD'];

		parent::__construct($this->dhb, $this->user, $this->pwd);
	}
}