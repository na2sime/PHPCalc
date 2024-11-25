<?php

namespace App;

use App\Expression\Number;
use App\Expression\Operator;
use App\Operator\Addition;
use App\Operator\Subtraction;
use App\Operator\Multiplication;
use App\Operator\Division;

class Parser
{
    private $operators = [];

    public function __construct()
    {
        $this->operators['+'] = Addition::class;
        $this->operators['-'] = Subtraction::class;
        $this->operators['*'] = Multiplication::class;
        $this->operators['/'] = Division::class;
    }

    public function parse($expression)
    {
        $outputQueue = [];
        $operatorStack = [];

        $tokens = $this->tokenize($expression);

        foreach ($tokens as $token) {
            if (is_numeric($token)) {
                $outputQueue[] = new Number($token);
            } elseif (isset($this->operators[$token])) {
                while (!empty($operatorStack) && end($operatorStack) !== '(' &&
                    $this->operators[$token]::getPrecedence() <= end($operatorStack)::getPrecedence()) {
                    $outputQueue[] = new Operator(array_pop($operatorStack));
                }
                $operatorStack[] = $this->operators[$token];
            } elseif ($token === '(') {
                $operatorStack[] = $token;
            } elseif ($token === ')') {
                while (end($operatorStack) !== '(') {
                    if (empty($operatorStack)) {
                        throw new \InvalidArgumentException("Mismatched parentheses.");
                    }
                    $outputQueue[] = new Operator(array_pop($operatorStack));
                }
                array_pop($operatorStack);
            }
        }

        while (!empty($operatorStack)) {
            $op = array_pop($operatorStack);
            if ($op === '(') {
                throw new \InvalidArgumentException("Mismatched parentheses.");
            }
            $outputQueue[] = new Operator($op);
        }

        return $this->buildExpressionTree($outputQueue);
    }

    private function tokenize($expression)
    {
        $cleanedExpression = str_replace(' ', '', $expression);
        $pattern = '/(\d+|\+|\-|\*|\/|\(|\))/';
        preg_match_all($pattern, $cleanedExpression, $matches);
        return $matches[0];
    }

    private function buildExpressionTree($tokens)
    {
        $stack = new \SplStack();

        foreach ($tokens as $token) {
            if ($token instanceof Number) {
                $stack->push($token);
            } elseif ($token instanceof Operator) {
                $b = $stack->pop();
                $a = $stack->pop();
                $stack->push(new $token($a, $b));
            }
        }

        return $stack->pop();
    }
}
