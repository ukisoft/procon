<?php

namespace ProCon;

class OverlapPatternVer2
{
    public static function calc($n, $m, $a, $M)
    {
        if ($n === 0) {
            return 0;
        }
        $sums = [];
        $sums[0] = 1;
        foreach ($a as $key => $num) {
            $dp = [];
            for ($i = 0; $i <= $m; $i++) {
                if ($i === 0) {
                    $dp[$i] = 1;
                    continue;
                }
                if ($key === 0) {
                    $dp[$i] = $i <= $num ? 1 : 0;
                    continue;
                }
                if ($num >= $i) {
                    $dp[$i] = $sums[$i];
                    continue;
                }
                $dp[$i] = $sums[$i] - $sums[$i - $num - 1];
            }
            if ($key === $n - 1) {
                return $dp[$m];
            }
            foreach ($dp as $dpKey => $value) {
                if ($dpKey === 0) {
                    continue;
                }
                $sums[$dpKey] = ($sums[$dpKey - 1] + $dp[$dpKey]) % $M;
            }
        }
        return 0;
    }
}