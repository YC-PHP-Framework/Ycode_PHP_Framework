<?php

namespace Yc\models;

use Yc\framework\Model;


class AuthModel extends Model
{
    // public string $username;
    // public string $email;
    // public string $password;
    // public string $confirm_password;
    // public string $created_at;
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }
    public function rules($auth): array
    {

        return $this->user->rules($auth);
    }

    public function register()
    {
      
       redirect('/login');
        // header("location: /login");
    }

    public function login()
    {
        return "Login Form Submitted";
    }
}
