<?php

namespace Classes\Interface;

/**
 * ValidationInterface will dictate to ValidatioBase class the 
 * necessary methods to be used in order to work the desired way.
 * 
 * It contains specific methods to validate a string, which can be any input
 * provided, store possible errors when validating fields and possibility to 
 * get those erros.
 */
Interface ValidationInterface {

	public function splitValidationRules();
	
	public function validate();

	/**
	 * Check fields.
	 * 
	 * Will check all fields passsed in $data array if are set and if the
	 * length is not 0.
	 * 
	 * @param	array	$data		data to be checked for existance.
	 * @return	array|bool			either an array with message to each field or true instead.
	 */
	public static function checkExistance(array $data);

	public function storeErrorOnValidation();

	public function getError();
}