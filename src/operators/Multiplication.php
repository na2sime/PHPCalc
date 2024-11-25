<?php
namespace App\Operator;

use App\api\IOperator;

class Multiplication implements IOperator
{
    public function calculate($a, $b)
    {
        return $a * $b;
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
