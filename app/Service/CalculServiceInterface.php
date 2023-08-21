<?php
namespace Yc\App\Service;

interface CalculServiceInterface{
    public function calcul(int|float $num1, int|float $num2);
}