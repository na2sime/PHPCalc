<?php
require 'vendor/autoload.php';

use App\Calculator;

if ($argc < 2) {
    echo "Usage: php calc.php <expression>\n";
    exit(1);
}

try {
    $calculator = new Calculator();
    $expression = $argv[1];
    $result = $calculator->calculate($expression);
    echo "Result: $result\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}