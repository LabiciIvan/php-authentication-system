<?php

namespace Classes;

require __DIR__ . "./Base/ValidationBase.php";

use Classes\Base\ValidationBase;

/**
 * Validates input fields.
 * 
 * This is an extension of the parent {@link ValidationBase}
 * class, inheriting most of it's methods.
 * 
 * It is a simplification keeping the logic in the base class.
 * 
 * Validation requires an associative array with names which are
 * the field names and value which are the field values.
 * 
 * In the same way requires an associative array with names
 * representing the field names and values will be the rules that
 * will apply to it.
 * 
 * Example :
 * -------------------------------------------------------------
 * |						Fields								|
 * -------------------------------------------------------------
 * $fields = [
 *     'name'       => 'John Doe',
 *     'email'      => 'johnDoe@email.com',
 *     'pwd'        => 'secret',
 *     'pwd_repeat' => 'secret',
 * ]
 * -------------------------------------------------------------
 * |						Rules								|
 * -------------------------------------------------------------
 * $rules = [
 *     'name'       => 'required|min:3|max:20',
 *     'email'      => 'required|isEmail',
 *     'pwd'        => 'min:5|max:10|repeat',
 *     'pwd_repeat' => 'required',
 * ]
 */
class Validation extends ValidationBase {

	public function __construct($fields, $rules) {
		parent::__construct($fields, $rules);
	}
}