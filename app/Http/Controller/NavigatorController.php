<?php

namespace Yc\App\Http\Controller;

use Yc\framework\App;
use Yc\framework\Controller;
use Yc\App\Service\TestService;

// use Main\app\Renderable;

class NavigatorController extends Controller
{
    public function index()
    {



        // var_dump($db1); 
        // $users = App::DB()->query("SELECT * FROM users ")->getAll();
        // dd($users);
        $test =  $this->container->get(TestService::class)->add();
        dd($test);

        // dd($this->get_request('arg'));

        $params = [
            'name' => "Abdelmalek Achkif"
        ];

        // return Renderable::view('home', $params);
        return $this->view('home', $params);
    }
    public function login()
    {
        return $this->view('auth/login');
    }

    public function register()
    {
        return $this->view('auth/register');
    }
}
