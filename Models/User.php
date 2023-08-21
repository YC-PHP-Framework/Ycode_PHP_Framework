<?php

namespace App\models;

use App\framework\Model;

class User extends Model
{
    public string $username;
    public string $email;
    public string $password;
    public string $confirm_password;
    public string $created_at;


    public function rules($auth): array
    {

        if ($auth === "login") {

            return [
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                'password' => [self::RULE_REQUIRED],
            ];
        } else {

            return [
                'username' => [self::RULE_REQUIRED],
                'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
                'password' => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 8], [self::RULE_MAX, "max" => 24]],
                'confirm_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]],
            ];
        }
    }
}
