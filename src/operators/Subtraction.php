<?php
namespace App\Operator;

use App\IOperator;

class Subtraction implements IOperator
{
    public function calculate($a, $b)
    {
        return $a - $b;
    }
}
