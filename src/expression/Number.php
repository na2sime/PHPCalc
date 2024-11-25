<?php

namespace App\Expression;

use App\api\IExpression;

class Number implements IExpression
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function evaluate()
    {
        return $this->value;
    }
}
