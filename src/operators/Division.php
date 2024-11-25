<?php
namespace App\Operator;

use App\IOperator;

class Division implements IOperator
{
    public function calculate($a, $b)
    {
        if ($b == 0) {
            throw new \InvalidArgumentException("Division by zero.");
        }
        return $a / $b;
    }
}
