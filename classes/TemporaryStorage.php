<?php

namespace Classes;

require __DIR__ . "/Base/BaseTemporaryStorage.php";
use Classes\Base\BaseTemporaryStorage;


/**
 * Eases the work with sessions.
 * 
 * This class extends the parent class {@link BaseTemporaryStorage}, and 
 * uses the {@link store()} method to store in session the data by calling
 * the {@link storeInSession()} method of parent class.
 */
class TemporaryStorage extends BaseTemporaryStorage{
	
	/**
	 * Store data in session.
	 */
	public function store() {
		self::storeInSession();
	}
}

?>