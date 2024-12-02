<?php

$file = file('input.txt');

$safeReports = 0;

foreach ($file as $line) {
    $levels = explode(" ", $line);

    $previousLevel = null;
    $levelsIncrease = null;
    $firstLevelCheck = true;
    $reportCorrect = true;

    foreach ($levels as $level) {
        if ($previousLevel != null) {
            $levelDifference = $previousLevel - $level;

            if ($levelDifference > 3 || $levelDifference < -3 || $levelDifference == 0) {
                $reportCorrect = false;
            }

            if ($firstLevelCheck) {
                if ($levelDifference > 0) {
                    $levelsIncrease = true;
                }

                $firstLevelCheck = false;
            } else {
                if (($levelsIncrease && $levelDifference <= 0) || (!$levelsIncrease && $levelDifference >= 0)) {
                    $reportCorrect = false;
                }
            }
        }
        $previousLevel = $level;
    }

    if ($reportCorrect) {
        $safeReports++;
    }
    var_dump($reportCorrect);
//    die();
}

echo "Safe reports: " . $safeReports . "\n";