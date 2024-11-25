<?php
namespace App\Operator;

use App\IOperator;

class Multiplication implements IOperator
{
    public function calculate($a, $b)
    {
        return $a * $b;
    }
}
