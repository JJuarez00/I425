<?php
/**
 * Author: Joseph Juarez
 * Date: 10/9/25
 * File: Validator.php
 * Description: This file was created in module 7!
 */

namespace MyCollegeAPI\Validation;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;
class Validator {
    private static array $errors = [];

    // A generic validation method. it returns true on success or false on failed validation.
    public static function validate($request, array $rules) : bool {
        foreach ($rules as $field => $rule) {
            //Retrieve parameters from URL or the request body
            $param = $request->getAttribute($field) ?? $request->getParsedBody()[$field];
            try{
                $rule->setName($field)->assert($param);
            } catch (NestedValidationException $ex) {
                self::$errors[$field] = $ex->getFullMessage();
            }
        }
        // Return true or false; "false" means a failed validation.
        return empty(self::$errors);
    }

    //Validate student data.
    public static function validateStudent($request) : bool {
        //Define all the validation rules
        $rules = [
            'id' => v::notEmpty()->alnum()->startsWith('s')->length(5, 5),
            'name' => v::alnum(' '),
            'email' => v::email(),
            'major' => v::alpha(' '),
            'gpa' => v::numericVal()
        ];

        return self::validate($request, $rules);
    }

    // Validate attributes of a User model. Do not validate fields having default values (id, created_at, and updated_at)
    public static function validateUser($request) : bool {
        $rules = [
            'name' => v::alnum(' '),
            'email' => v::email(),
            'username' => v::notEmpty(),
            'password' => v::notEmpty(),
            'role' => v::number()->between(1, 4)
        ];

        return self::validate($request, $rules);
    }

    //Return the errors in an array
    public static function getErrors() : array {
        return self::$errors;
    }
}