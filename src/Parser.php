<?php
namespace App;

class Parser
{
    public function parse($expression)
    {
        $cleanedExpression = str_replace(' ', '', $expression);
        $pattern = '/(\d+|\D)/';
        preg_match_all($pattern, $cleanedExpression, $matches);
        return $matches[0];
    }
}
