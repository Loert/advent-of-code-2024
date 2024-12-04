<?php

$input = extractInput('input.txt');
$inputMatrix = extractInputToMatrix('input.txt');

$totalHorizontal = countHorizontally($input) + countHorizontally($input, true);
$totalVertical = countVertically($inputMatrix) + countVertically($inputMatrix, true);
$totalDiagonnal = countDiagonnaly($inputMatrix) + countDiagonnaly($inputMatrix, true);

echo "XMAS appear " . $totalHorizontal . " horizontally <br>";
echo "XMAS appear " . $totalVertical . " vertically <br>";
echo "XMAS appear " . $totalDiagonnal . " diagonally <br>";
echo "XMAS appear " . $totalHorizontal + $totalVertical + $totalDiagonnal . " in total<br>";

function extractInput($inputFilePath) {
    $file = file($inputFilePath);
    $rows = [];
    foreach ($file as $line) {
        $rows[] = $line;
    }
    return $rows;
}

function extractInputToMatrix($inputFilePath) {
    $file = file($inputFilePath);
    $rows = [];
    foreach ($file as $line) {
        $rows[] = str_split(trim($line));
    }
    return $rows;
}

function countHorizontally($rows, $backward = false) {
    $total = 0;

    foreach ($rows as $row) {
        $total += substr_count($row, $backward ? "SAMX" : "XMAS");
    }

    return $total;
}

function countVertically(array $rows, bool $backward = false) {
    // Transpose array to put columns as rows
    $transposed = [];
    foreach ($rows as $row) {
        foreach ($row as $colIndex => $value) {
            $transposed[$colIndex][] = $value;
        }
    }

    $transposedString = [];
    // Recreate strings
    foreach ($transposed as $row) {
        $transposedString[] = implode("", $row);
    }

    return countHorizontally($transposedString, $backward);
}

function countDiagonnaly(array $rows, bool $backward = false) {
    $diagonals = getDiagonals($rows);

    $diagonalsString = [];
    foreach ($diagonals as $diagonal) {
        $diagonalsString[] = implode("", $diagonal);
    }

    return countHorizontally($diagonalsString, $backward);
}

function getDiagonals($array) {
    $diagonals = [];
    $rowCount = count($array);
    $colCount = count($array[0]);

    // From up-left to down right
    for ($d = 0; $d < $rowCount + $colCount - 1; $d++) {
        $diagonal = [];
        for ($row = 0; $row < $rowCount; $row++) {
            $col = $d - $row;
            if ($col >= 0 && $col < $colCount) {
                $diagonal[] = $array[$row][$col];
            }
        }
        $diagonals[] = $diagonal;
    }

    // From up-right to down-left
    for ($d = 0; $d < $rowCount + $colCount - 1; $d++) {
        $diagonal = [];
        for ($row = 0; $row < $rowCount; $row++) {
            $col = $d - ($rowCount - 1 - $row);
            if ($col >= 0 && $col < $colCount) {
                $diagonal[] = $array[$row][$col];
            }
        }
        $diagonals[] = $diagonal;
    }

    return $diagonals;
}
