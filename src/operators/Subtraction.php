<?php
namespace App\Operator;

use App\api\IOperator;

class Subtraction implements IOperator
{
    public function calculate($a, $b)
    {
        return $a - $b;
    }

    public static function getPrecedence()
    {
        return 1;
    }

    public static function getAssociativity()
    {
        return 'L';
    }
}
