<?php

namespace ProCon;

class LongestCommonSubsequence
{
    public static function calc($firstWords, $secondWords)
    {
        $maxLengths = [];
        for ($i = mb_strlen($firstWords) - 1; $i >= 0; $i--) {
            $selfLengths = [];
            $maxLength = count($maxLengths) === 0 ? 0 : $maxLengths[min(array_keys($maxLengths))];
            for ($j = mb_strlen($secondWords) - 1; $j >= 0; $j--) {
                if ($firstWords[$i] === $secondWords[$j]) {
                    $selfLengths[$j] = $maxLength + 1;
                }
            }
            $maxLengths = $selfLengths + $maxLengths;
        }
        return count($maxLengths) === 0 ? 0 : max($maxLengths);
    }
}