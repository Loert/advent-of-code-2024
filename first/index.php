<?php

$input = extractInput('input.txt');

$arrayLeft = $input[0];
$arrayRight = $input[1];

sort($arrayLeft);
sort($arrayRight);

// Evaluate distances
$totalDistance = 0;

for ($i = 0; $i < count($arrayLeft); $i++) {
    $distance = $arrayRight[$i] - $arrayLeft[$i];
    if ($distance < 0) {
        $distance *= -1;
    }
    $totalDistance += $distance;
}

echo "The total distance is: " . $totalDistance;

$totalSimilarity = 0;
// Evaluate similarity score
for ($i = 0; $i < count($arrayLeft); $i++) {
    $occurences = array_count_values($arrayRight);
    $similarity = $occurences[$arrayLeft[$i]] ?? 0;
    $totalSimilarity += $similarity * $arrayLeft[$i];
}

echo "The similarity score is: " . $totalSimilarity;

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