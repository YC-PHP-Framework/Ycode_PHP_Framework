<?php

namespace Yc\App\Service;

class AdditionOpService implements CalculServiceInterface
{
    public function __construct()
    {
        
    }

    public function calcul($num1, $num2)
    {
        return   $num1 + $num2;
    }
}
