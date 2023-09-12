<?php

namespace Yc\App\Http\Controller;

use Yc\framework\App;
use Yc\framework\Controller;
use Yc\App\Service\TestService;
use Yc\framework\Renderable;

// use Main\app\Renderable;

class NavigatorController extends Controller
{


    public function index()
    {

        $add =  $this->container->get(TestService::class)->sub();
        // dd($add);

        $params = [
            'name' => "Abdelmalek Achkif",

        ];

        return Renderable::view('home', $params);
        // return $this->view('home', $params);
    }

    public function login()
    {
        return $this->view('auth/login');
    }

    public function register()
    {
        return $this->view('auth/register');
    }

    public function profile()
    {
        $params = [
            'name' => "Abdelmalek Achkif",

        ];
        return Renderable::view('profile', $params);
    }
}
