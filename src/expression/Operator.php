<?php
namespace App\Expression;

use App\api\IExpression;

class Operator implements IExpression
{
    private $left;
    private $right;
    private $operatorClass;

    public function __construct($operatorClass, $left = null, $right = null)
    {
        $this->operatorClass = $operatorClass;
        $this->left = $left;
        $this->right = $right;
    }

    public function evaluate()
    {
        $operator = new $this->operatorClass();
        return $operator->calculate($this->left->evaluate(), $this->right->evaluate());
    }
}
