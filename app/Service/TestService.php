<?php

namespace Yc\App\Service;


class TestService
{

    public function __construct(
        protected PrintName $printName,
        protected CalculServiceInterface $calulOperation
    ) {
    }

    public function print(string $name)
    {
        return $this->printName->print($name);
    }

    public function sub()
    {
        return $this->calulOperation->calcul(10, 8);
    }
    public function add()
    {
        return $this->calulOperation->calcul(10, 8);
    }
}
