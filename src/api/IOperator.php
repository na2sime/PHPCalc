<?php

namespace App\api;
interface IOperator
{
    public function calculate($a, $b);

    public static function getPrecedence();

    public static function getAssociativity();
}
