<?php

$vv = (int)trim(fgets(STDIN));

if ($vv < 100) {
    echo '00' . "\n";
}
if ($vv >= 100 && $vv < 1000) {
    echo substr('0' . (string)($vv / 100), 0, 2) . "\n";
}
if ($vv >= 1000 && $vv <= 5000) {
    echo substr((string)($vv / 100), 0, 2) . "\n";
}
if ($vv >= 6000 && $vv <= 30000) {
    echo substr((string)(($vv / 1000) + 50), 0, 2) . "\n";
}
if ($vv >= 35000 && $vv <= 70000) {
    echo substr((string)(((($vv / 1000) - 30) / 5) + 80), 0, 2) . "\n";
}
if ($vv > 70000) {
    echo "89\n";
}