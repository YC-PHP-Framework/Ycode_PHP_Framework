<?php

namespace Yc\framework;

use Exception;

class Validator
{
    // public array $data;
    public function __construct(public array $data)
    {
        $this->data = $data;
    }

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';
    public const RULE_DIGIT = 'digit';


    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value)  <= $max;
    }

    public static function is_email(string $value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }


    public static function digit($value)
    {
        $value = trim($value);
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }

    public function rules($ruleName, array|string $fields, string $params = null)
    {

        if (!method_exists(__CLASS__, $ruleName)) {
            // throw new Exception("{$ruleName} does not exist in as a ruleName");
            throw new \InvalidArgumentException(
                "Rule {$ruleName} has not been registered in " . get_called_class() . "as a ruleName"
            );
        }
        if (is_array($fields)) {
            // required , [username, email] / email
            foreach ($fields as $key) {
                if (isset($this->data[$key]) && array_key_exists($key, $this->data)) {
                    // {$key} is Existed 
                    $this->validatedFileds[$key][] = $ruleName;
                } else {
                    // {$key} does not exist 
                    throw new \InvalidArgumentException("{$key} does not exist in parameters");
                }
            }
        } else {
            if (isset($this->data[$fields]) && array_key_exists($fields, $this->data)) {
                // echo "{$fields} is Existed" . PHP_EOL;
                if (!$params) {
                    $this->validatedFileds[$fields][] = $ruleName;
                } else {
                    $this->validatedFileds[$fields][] = [$ruleName => $params];
                    // $this->validatedFileds[$fields][$params] = $ruleName;
                }
            } else {
                // echo "{$fields} does not exist ";
                throw new \InvalidArgumentException("{$fields} does not exist in parameters");
            }
        }
    }

    public array $errors = [];
    public array $validatedFileds = [];

    public function validated()
    {
        foreach ($this->validatedFileds as $key => $fields) {
            // echo $key  . "=>";
            // var_dump($fields);
            // echo '</br>';

            foreach ($fields as $field) {
                if (is_array($field)) {
                    foreach ($field as $fieldKey => $val) {
                        call_user_func(array(__CLASS__, $fieldKey), $key, $val);
                    }
                } else {
                    call_user_func(array(__CLASS__, $field), $key);
                }
            }
        }

        return empty($this->errors);
    }


    protected function required($field)
    {
        if ($this->validatedFileds[$field] && empty($this->data[$field])) {
            $this->setError($field, self::RULE_REQUIRED);
        }
    }

    protected function email($field)
    {
        if (!self::is_email($this->data[$field])) {
            $this->setError($field, self::RULE_EMAIL);
        }
    }

    protected function match($field, $matched)
    {
        if ($this->data[$field] !== $this->data[$matched]) {
            $this->setError($field, self::RULE_MATCH, $matched);
        }
    }

    protected function min($field, $ruleMin)
    {
        if (strlen($this->data[$field]) < $ruleMin) {
            $this->setError($field, self::RULE_MIN, $ruleMin);
        }
    }

    protected function max($field, $ruleMax)
    {
        if (strlen($this->data[$field]) > $ruleMax) {
            $this->setError($field, self::RULE_MAX, $ruleMax);
        }
    }


    public function setError(string $field, string $rule, $param = null)
    {
        $message = $this->errorMessage()[$rule] ?? "";
        $message = str_replace("{{$rule}}", $param, $message);

        $this->errors[$field][] = $message;
    }

    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_DIGIT => 'This field must a digit',
        ];
    }

    public function hasError($field)
    {
        return  $this->errors[$field] ?? false;
    }

    public function getError($field)
    {
        return $this->errors[$field][0] ?? false;
    }
}
