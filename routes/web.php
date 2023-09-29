<?php

use Yc\framework\Router;
use Yc\app\Http\Controller\AuthController;
use Yc\app\Http\Controller\NavigatorController;

// #Note : 
// If you call any Route::method outside of the routes/web.php file it is not going to work .

Router::get('/', [NavigatorController::class, 'index'], ["auth"]);
Router::get('/login', [NavigatorController::class, 'login']);
Router::post('/login', [AuthController::class, 'login']);
Router::get('/register', [NavigatorController::class, 'register']);
Router::post('/register', [AuthController::class, 'register']);
Router::get('/profile', [NavigatorController::class, 'profile'], "auth");

Router::get('/router', function () {
    echo  ' Hello Your Router works perfectely';
}, "guest");
