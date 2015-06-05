<?php

namespace ProCon;

class PartialSumWithLimit
{
    public static function calc($a, $m, $k)
    {
        $dp = [0];
        for ($i = 0; $i < count($a); $i++) {
            $nextCalcSet = [];
            for ($j = 1; $j <= $m[$i]; $j++) {
                $nextCalc = $a[$i] * $j;
                if ($nextCalc === $k) {
                    return true;
                }
                $nextCalcSet[] = $nextCalc;
            }
            $countDp = count($dp);
            for ($j = 0; $j < $countDp; $j++) {
                foreach ($nextCalcSet as $nextCalc) {
                    $nextOneDp = $dp[$j] + $nextCalc;
                    if ($nextOneDp === $k) {
                        return true;
                    }
                    if (in_array($nextOneDp, $dp) === false) {
                        $dp[] = $nextOneDp;
                    }
                }
            }
        }
        return false;
    }
}