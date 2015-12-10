<?php

namespace ProCon;

class LongestCommonSubsequence
{
    public static function calc($firstWords, $secondWords)
    {
        $maxLengths = [];
        for ($i = mb_strlen($firstWords) - 1; $i >= 0; $i--) {

            $checkLengths = [];
            $checkMaxLength = 0;
            for ($j = mb_strlen($secondWords) - 1; $j >= 0; $j--) {
                if (array_key_exists($j + 1, $maxLengths)) {
                    $checkMaxLength = max($checkMaxLength, $maxLengths[$j + 1]);
                }
                $checkLengths[$j] = $checkMaxLength;
            }

            $selfLengths = [];
            for ($j = mb_strlen($secondWords) - 1; $j >= 0; $j--) {
                if ($firstWords[$i] === $secondWords[$j]) {
                    $selfLengths[$j] = $checkLengths[$j] + 1;
                }
            }
            $maxLengths = $selfLengths + $maxLengths;
        }
        return count($maxLengths) === 0 ? 0 : max($maxLengths);
    }
}