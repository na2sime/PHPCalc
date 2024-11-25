<?php
namespace App;

use App\Parser;

class Calculator
{
    private $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function calculate($expression)
    {
        $expressionTree = $this->parser->parse($expression);
        return $expressionTree->evaluate();
    }
}
