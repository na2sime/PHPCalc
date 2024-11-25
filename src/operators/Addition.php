<?php
namespace App\Operator;

use App\IOperator;

class Addition implements IOperator
{
    public function calculate($a, $b)
    {
        return $a + $b;
    }
}
