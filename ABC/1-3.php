<?php

$inputs = explode(' ', trim(fgets(STDIN)));
$deg = (int)$inputs[0];
$dis = round((int)$inputs[1] / 60, 1);

$dir = 'N';
$w = 0;

if ($dis >= 0 && $dis <= 0.2) {
    echo 'C ' . (string)$w . "\n";
    return;
}
if ($dis >= 0.3 && $dis <= 1.5) {
    $w = 1;
}
if ($dis >= 1.6 && $dis <= 3.3) {
    $w = 2;
}
if ($dis >= 3.4 && $dis <= 5.4) {
    $w = 3;
}
if ($dis >= 5.5 && $dis <= 7.9) {
    $w = 4;
}
if ($dis >= 8.0 && $dis <= 10.7) {
    $w = 5;
}
if ($dis >= 10.8 && $dis <= 13.8) {
    $w = 6;
}
if ($dis >= 13.9 && $dis <= 17.1) {
    $w = 7;
}
if ($dis >= 17.2 && $dis <= 20.7) {
    $w = 8;
}
if ($dis >= 20.8 && $dis <= 24.4) {
    $w = 9;
}
if ($dis >= 24.5 && $dis <= 28.4) {
    $w = 10;
}
if ($dis >= 28.5 && $dis <= 32.6) {
    $w = 11;
}
if ($dis >= 32.7) {
    $w = 12;
}

if ($deg >= 11.25 * 10 && $deg < 33.75 * 10) {
    $dir = 'NNE';
}
if ($deg >= 33.75 * 10 && $deg < 56.25 * 10) {
    $dir = 'NE';
}
if ($deg >= 56.25 * 10 && $deg < 78.75 * 10) {
    $dir = 'ENE';
}
if ($deg >= 78.75 * 10 && $deg < 101.25 * 10) {
    $dir = 'E';
}
if ($deg >= 101.25 * 10 && $deg < 123.75 * 10) {
    $dir = 'ESE';
}
if ($deg >= 123.75 * 10 && $deg < 146.25 * 10) {
    $dir = 'SE';
}
if ($deg >= 146.25 * 10 && $deg < 168.75 * 10) {
    $dir = 'SSE';
}
if ($deg >= 168.75 * 10 && $deg < 191.25 * 10) {
    $dir = 'S';
}
if ($deg >= 191.25 * 10 && $deg < 213.75 * 10) {
    $dir = 'SSW';
}
if ($deg >= 213.75 * 10 && $deg < 236.25 * 10) {
    $dir = 'SW';
}
if ($deg >= 236.25 * 10 && $deg < 258.75 * 10) {
    $dir = 'WSW';
}
if ($deg >= 258.75 * 10 && $deg < 281.25 * 10) {
    $dir = 'W';
}
if ($deg >= 281.25 * 10 && $deg < 303.75 * 10) {
    $dir = 'WNW';
}
if ($deg >= 303.75 * 10 && $deg < 326.25 * 10) {
    $dir = 'NW';
}
if ($deg >= 326.25 * 10 && $deg < 348.75 * 10) {
    $dir = 'NNW';
}

echo $dir . ' ' . (string)$w . "\n";