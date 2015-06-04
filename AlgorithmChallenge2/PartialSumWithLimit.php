<?php

namespace ProCon;

class PartialSumWithLimit
{
    public static function calc($a, $m, $k)
    {
        $inputs = [];
        array_map(function ($a, $m) use (&$inputs, $k) {
            for ($i = 1; $i <= $m; $i++) {
                $value = $a * $i;
                if ($value <= $k) {
                    $inputs[] = $value;
                }
            }
        }, $a, $m);
        if (in_array($k, $inputs)) {
            return true;
        }
        $inputs = array_unique($inputs);

        $dp = [0];
        foreach ($inputs as $value) {
            $dpNum = count($dp);
            for ($i = 0; $i < $dpNum; $i++) {
                $nextValue = $dp[$i] + $value;
                if ($nextValue === $k) {
                    return true;
                }
                if ($nextValue > $k) {
                    continue;
                }
                if (in_array($nextValue, $dp) === false) {
                    $dp[] = $nextValue;
                }
            }
            rsort($dp);
        }
        return false;
    }
}