<?php
namespace App;

use App\Operator\Addition;
use App\Operator\Subtraction;
use App\Operator\Multiplication;
use App\Operator\Division;

class Calculator
{
    private $parser;
    private $operators = [];

    public function __construct()
    {
        $this->parser = new Parser();

        $this->operators['+'] = new Addition();
        $this->operators['-'] = new Subtraction();
        $this->operators['*'] = new Multiplication();
        $this->operators['/'] = new Division();
    }

    public function calculate($expression)
    {
        $tokens = $this->parser->parse($expression);
        return $this->evaluate($tokens);
    }

    private function evaluate($tokens)
    {
        $stack = new \SplStack();

        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                $stack->push($token);
            } else if (isset($this->operators[$token])) {
                $b = $stack->pop();
                $a = $stack->pop();
                $result = $this->operators[$token]->calculate($a, $b);
                $stack->push($result);
            }
        }

        return $stack->pop();
    }
}