<?php

$points = explode(' ', trim(fgets(STDIN)));

$secondPoint = array($points[2] - $points[0], $points[3] - $points[1]);
$thirdPoint = array($points[4] - $points[0], $points[5] - $points[1]);

echo (string)((abs($secondPoint[0] * $thirdPoint[1] - $secondPoint[1] * $thirdPoint[0])) / 2) . "\n";