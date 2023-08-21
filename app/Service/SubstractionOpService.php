<?php

namespace Yc\App\Service;


class SubstractionOpService implements CalculServiceInterface
{
    // public function __construct()
    // {
        
    // }

    public function calcul($num1, $num2)
    {
        return   $num1 - $num2;
    }
}
