<?php

$input = file_get_contents('input.txt');

$pattern = '/mul\(\d{1,3},\d{1,3}\)/';
$patternSecondStar = '/(mul\(\d{1,3},\d{1,3}\)|do\(\)|don\'t\(\))/';

preg_match_all($patternSecondStar, $input, $matches);

$total = 0;
$enabled = true;

foreach ($matches[0] as $methodOccurrence) {
    if ($methodOccurrence == 'do()') {
        $enabled = true;
    } elseif ($methodOccurrence == "don't()") {
        $enabled = false;
    } else {
        if ($enabled) {
            $total += eval('return ' . $methodOccurrence . ';');
        }
    }
}

echo "The total is : " . $total . "\n";

function mul(int $numberOne, int $numberTwo) {
    return $numberOne * $numberTwo;
}