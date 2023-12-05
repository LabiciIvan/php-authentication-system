<?php

namespace Classes\Base;

/**
 * Work with session.
 * 
 * Eases the work with super global $_SESSION.
 * 
 * This is a base class which is extended by {@link class TemporaryStorage} and
 * it helps to store data in session as well to retrieve data from session.
 * 
 * Requires before working with session to call {@link sessionStart()} and after
 * no longer working with it {@link sessionEnd()} to terminate session.
 */
class BaseTemporaryStorage {

	/**
	 * @param	array	$data			data to be stored.
	 */
	protected array $data;

	/**
	 * @param	string	$path_name		name under which $data will be stored.
	 */
	protected string $path_name;

	public function __construct(array $data, string $path_name) {
		$this->data = $data;
		$this->path_name = $path_name;
	}

	/**
	 * Helps to start the session.
	 */
	public static function sessionStart() {
		session_start();
	}

	/**
	 * Helps to terminate the session.
	 * 
	 * Will unset and terminal all data stored in session.
	 */
	public static function sessionEnd() {
		session_unset();
		session_destroy();
	}

	/**
	 * Store data in session.
	 * 
	 * The data stored will be under the $path_name, provided
	 * when creating a new instance of the class.
	 */
	protected function storeInSession() {
		$_SESSION[$this->path_name] = $this->data;
	}

	/**
	 * Return the data from session.
	 * 
	 * This is a static method which will help to retrieve
	 * data stored in session under a specific $path_name.
	 * 
	 * @param	string		$path		path where the data will be pulled from.
	 */
	public static function getData($path) {
		return (isset($_SESSION[$path]) ? $_SESSION[$path] : null);
	}
}

?>