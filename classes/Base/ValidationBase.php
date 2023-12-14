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

	protected array $expressions = [
		'required'	=> 'required',
		'max'		=> 'max',
		'min'		=> 'min',
	];

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
	 * @param	array	$fields				Fields to be validated.
	 * @param	array	$rules				Rules for the fields to be validated.
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
				$array_rules = explode("|", $rule);
			} else {
				$array_rules = explode(" ", $rule);
			}

			$this->rules[$key] = $array_rules;
		}
	}

	/**
	 * Validate fields.
	 * 
	 * Validates each field present in rules.
	 * 
	 * It works by accessing the field from $this->fields array
	 * specific to each field name present in $this->rules array.
	 */
	public function validate() {
		foreach ($this->rules as $key => $rule) {
			foreach ($rule as $r) {
				// Set as null, so no previous value is remebered.
				$rule_name		= null;
				$rule_condition	= null;

				// Check for functions with conditions.
				if (strpos($r, ":")) {
					list($rule_name, $rule_condition) = explode(":", $r);
				}
				
				// Get the function from $this->expressions array.
				$function = $this->expressions[(isset($rule_name) ? $rule_name : $r)];

				// Each function must contain a second parameter called $rule_condition.
				// E.g. function 'max:50' it has the $rule_condition as 50.
				// Functions which don't contain a $rule_condition just pass null e.g 'required'.
				$this->$function($key, (isset($rule_condition) ? $rule_condition : null));
			}
		}
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

	/**
	 * Store errors.
	 * 
	 * Stores errors based on the provided key.
	 * 
	 * @param	string	$key				The field name.
	 * @param	string	$message			The message error.
	 */
	public function storeErrorOnValidation($key, $message) {
		$this->errors[$key][] = $message;
	}

	public function getError() {
		return (isset($this->errors) ? $this->errors : null);
	}

	/**
	 * Check presence.
	 * 
	 * Check if the field is present.
	 * 
	 * @param	string	$key				The field name.
	 * @param	string	$rule_condition		Condition to the rule.
	 */
	private function required($key, string $rule_condition = null) {
		$is_present = (isset($this->fields[$key]) ? true : false);

		if ($is_present) {
			$is_present = (strlen($this->fields[$key]) !== 0 ? true : false);
		}
		
		if (!$is_present) {
			$this->storeErrorOnValidation($key, "Field {$key} is required.");
		}
	}

	/**
	 * Check maximum length.
	 * 
	 * Check if the field length doesn't exceed the maximum length.
	 * 
	 * @param	string	$key				The field name.
	 * @param	string	$rule_condition		Condition to the rule.
	 */
	private function max(string $key, string $rule_condition = null): void {
		$max_error = null;

		if (isset($this->fields[$key])) {
			$max_error = ((strlen($this->fields[$key]) > (int)$rule_condition) ? "Field {$key} can be maximum {$rule_condition} chars !" : null);
		}

		if (isset($max_error)) {
			$this->storeErrorOnValidation($key, $max_error);
		}
	}

	/**
	 * Check minumum length.
	 * 
	 * Check if the field has the minimum length.
	 * 
	 * @param	string	$key					The field name.
	 * @param	string	$rule_condition			Condition to the rule.
	 */
	private function min(string $key, string $rule_condition = null): void {
		$min_error = null;

		if (isset($this->fields[$key])) {
			$min_error = ((strlen($this->fields[$key]) < (int)$rule_condition) ? "Field {$key} must be minimum {$rule_condition} chars !" : null);
		}

		if (isset($min_error)) {
			$this->storeErrorOnValidation($key, $min_error);
		}
	}
}