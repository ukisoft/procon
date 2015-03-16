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
                if ($firstWords[$i] === $secondWords[$j]) {
                    $maxLength = 0;
                    for ($k = $j - 1; $k >= 0; $k--) {
                        if (is_null($maxLengths[$k]) === false) {
                            $maxLength = $maxLengths[$k];
                            break;
                        }
                    }
                    $selfLengths[$j] = $maxLength + 1;
                    continue;
                }
                $maxLength = 0;
                for ($k = $j - 1; $k >= 0; $k--) {
                    if (is_null($selfLengths[$k]) === false) {
                        $maxLength = $selfLengths[$k];
                        break;
                    }
                }
                $selfLengths[$j] = $maxLength;
            }
            $maxLengths = $selfLengths + $maxLengths;
        }
        return count($maxLengths) === 0 ? 0 : max($maxLengths);
    }
}