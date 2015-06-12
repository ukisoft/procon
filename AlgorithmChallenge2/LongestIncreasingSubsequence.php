<?php

namespace ProCon;


class LongestIncreasingSubsequence
{
    public static function solve($a)
    {
        $dp = [];
        for ($i = 0; $i < count($a); $i++) {
            $dp[$i] = 1;
            for ($j = 0; $j < $i; $j++) {
                if ($a[$j] < $a[$i] && $dp[$j] >= $dp[$i]) {
                    $dp[$i] = $dp[$j] + 1;
                }
            }
        }
        return $dp[count($a) - 1];
    }
}