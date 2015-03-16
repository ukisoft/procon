<?php

namespace ProCon;

class LongestCommonSubsequence
{
    public static function calc($firstWords, $secondWords)
    {
        $maxLengths = [];
        for ($i = 0; $i < mb_strlen($firstWords); $i++) {
            $selfLengths = [];
            for ($j = 0; $j < mb_strlen($secondWords); $j++) {
                $maxLength = 0;
                if ($firstWords[$i] === $secondWords[$j]) {
                    if ($j - 1 >= 0) {
                        $maxLength = $maxLengths[$j - 1];
                    }
                    $selfLengths[$j] = $maxLength + 1;
                    continue;
                }
                if ($j - 1 >= 0) {
                    $maxLength = $selfLengths[$j - 1];
                }
                $selfLengths[$j] = $maxLength;
            }
            $maxLengths = $selfLengths + $maxLengths;
        }
        return count($maxLengths) === 0 ? 0 : max($maxLengths);
    }
}