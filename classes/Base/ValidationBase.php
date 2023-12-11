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

	protected array $fields;

	protected array $rules;

	protected ?array $errors = null;

	protected array $expressions = [];

	public function __construct(array $fields, array $rules) {
		$this->process($fields, $rules);
	}

	/**
	 * Initialise the process.
	 * 
	 * Initialise the process to start the validation of the fields.
	 * 
	 * Fields validation is based on the provided rules.
	 * 
	 * Rules is just an array composed out the Fields names as keys
	 * and it's values which is a string separated by a "|" pipe.
	 * 
	 * @param	array	$fields		Fields to be validated.
	 * @param	array	$rules		Rules for the fields to be validated.
	 * 
	 * @return	void
	 */
	private function process(array $fields, array $rules):void {
		$this->fields	= $fields;
		$this->rules	= $rules;

		$this->validationStart();
	}

	/**
	 * Start validation.
	 * 
	 * Starts the validation process based on the provided rules.
	 * 
	 * Calls the required methods to obtain a validation on each field.
	 * 
	 * @return	void
	 */
	public function validationStart(): void {
		$this->rulesToArray();
	}

	/**
	 * Rules to array.
	 * 
	 * Takes every rule and convert it from a string to an array.
	 * 
	 * @return	void
	 */
	private function rulesToArray(): void {
		foreach ($this->rules as $key => $rule) {
			$array_rules = null;

			if (strpos($rule, "|")) {
				echo "--" . $key . "contains | " . PHP_EOL;
				$array_rules = explode("|", $rule);
			} else {
				$array_rules = explode(" ", $rule);
			}

			$this->rules[$key] = $array_rules;
		}
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