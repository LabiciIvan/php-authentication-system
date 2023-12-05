<?php

namespace Classes\Base;

require __DIR__ . "/../Interface/ValidationInterface.php";
use Classes\Interface\ValidationInterface;

/**
 * Validates inputs fields;
 * 
 * This is a base class which will validate fields.
 * 
 * It implements the ValidationInterface which dictates
 * the methods required in order to function.
 * 
 * Contains a few static method which will help to check some
 * fields for existance, like method {@link checkExistance()}.
 */
class ValidationBase implements ValidationInterface {

	protected array $data;

	protected ?array $errors = null;

	protected array $validation_fields;
	
	protected array $expressions = [];

	public function __construct(array $data, array $validation_fields) {
		$this->data = $data;
		$this->validation_fields = $validation_fields;
	}

	public function splitValidationRules() {
		//@TODO
	}

	public function validate() {
		//@TODO
	}

	public static function checkExistance(array $data) {

		$errors = null;

		foreach ($data as $key => $field) {
			if (!isset($field) || strlen($field) === 0) {
				$errors[$key] = $key . ' is required';
			}
		}

		return (isset($errors) ? $errors : true);

	}

	public function storeErrorOnValidation() {
		//@TODO
	}

	public function getError() {
		return (isset($this->errors) ? $this->errors : null);
	}
}