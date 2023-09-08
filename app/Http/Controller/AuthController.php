<?php

namespace Yc\App\Http\Controller;

use Yc\framework\Controller;
use Yc\framework\Request;
use Yc\framework\Validator;
use Yc\models\User;
use Yc\models\AuthModel;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $data = $request->all();
        $validator = new Validator($data);

        $validator->rules('required', ['email', 'password']);
        $validator->rules('email', 'email');
        $validator->rules('min', 'password', 8);

        if ($validator->validated()) {
            redirect('/');
        }


        return $this->view('auth/login', [
            'validator' => $validator,

        ]);
    }

    public function register(Request $request)
    {

        $data = $request->all();
        $validator = new Validator($data);

        $validator->rules('required', ['username', 'email', 'password', 'confirm_password']);
        $validator->rules('email', 'email');
        $validator->rules('min', 'password', 8);
        $validator->rules('max', 'password', 24);
        $validator->rules('match', 'confirm_password', 'password');
       

        if ($validator->validated()) {

            redirect('/login');
        }


        return $this->view('auth/register', [
            'validator' => $validator,

        ]);
    }
}
