<?php

namespace ProCon;

class PartialSumWithLimit
{
    public static function calc($a, $m, $k)
    {
        $dp = [];
        $dp[0] = [];
        for ($i = 0; $i <= $k; $i++) {
            if ($i === 0) {
                $dp[0][$i] = 1;
                continue;
            }
            $dp[0][$i] = 0;
        }

        for ($i = 1; $i <= count($a); $i++) {
            for ($j = 0; $j <= $k; $j++) {
                if ($dp[$i - 1][$j] > 0) {
                    if ($j === $k) {
                        return true;
                    }
                    $dp[$i][$j] = $m[$i - 1] + 1;
                    continue;
                }
                if (array_key_exists($j - $a[$i - 1], $dp[$i])) {
                    if ($dp[$i][$j - $a[$i - 1]] > 0) {
                        if ($j === $k && ($dp[$i][$j - $a[$i - 1]] - 1) !== 0) {
                            return true;
                        }
                        $dp[$i][$j] = $dp[$i][$j - $a[$i - 1]] - 1;
                        continue;
                    }
                }
                $dp[$i][$j] = 0;
                continue;
            }
        }
        return false;
    }
}