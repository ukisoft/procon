<?php

$moneys = explode(' ', trim(fgets(STDIN)));
$leftMoney = (int)$moneys[0];
$rightMoney = (int)$moneys[1];

echo $leftMoney > $rightMoney ? $leftMoney . "\n" : $rightMoney . "\n";