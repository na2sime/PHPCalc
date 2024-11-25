<?php

namespace App\Operator;

use App\api\IOperator;

class Division implements IOperator
{
    public function calculate($a, $b)
    {
        if ($b == 0) {
            throw new \InvalidArgumentException("Division by zero.");
        }
        return $a / $b;
    }

    public static function getPrecedence()
    {
        return 2;
    }

    public static function getAssociativity()
    {
        return 'L';
    }
}
