<?php

$input = extractInput('input.txt');

$arrayLeft = $input[0];
$arrayRight = $input[1];

sort($arrayLeft);
sort($arrayRight);
$totalDistance = 0;

for ($i = 0; $i < count($arrayLeft); $i++) {
    $distance = $arrayRight[$i] - $arrayLeft[$i];
    if ($distance < 0) {
        $distance *= -1;
    }
    $totalDistance += $distance;
}

echo "The total distance is: " . $totalDistance;

function extractInput(string $inputFilePath): array
{
    $arrayLeft = [];
    $arrayRight = [];

    $file = file($inputFilePath);
    foreach ($file as $line) {
        $data = explode("   ", $line);
        $arrayLeft[] = (int)$data[0];
        $arrayRight[] = (int)$data[1];
    }

    return [$arrayLeft, $arrayRight];
}