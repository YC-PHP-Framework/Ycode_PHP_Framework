<?php

namespace Yc\App\Service;


class TestService
{

    public function __construct(
        protected SayService $sayHi,
        protected CalculServiceInterface $calulOperation
    ) {
    }

    public function sayHiTo(string $name)
    {
        return $this->sayHi->say($name);
    }

    public function add()
    {
        return $this->calulOperation->calcul(5, 8);
    }
}
