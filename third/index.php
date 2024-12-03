<?php

$input = file_get_contents('input.txt');

$pattern = '/mul\(\d{1,3},\d{1,3}\)/';

preg_match_all($pattern, $input, $matches);

$total = 0;

foreach ($matches[0] as $mulOccurence) {
    $total += eval('return ' . $mulOccurence . ';');
}

echo "The total is : " . $total . "\n";

function mul(int $numberOne, int $numberTwo) {
    return $numberOne * $numberTwo;
}