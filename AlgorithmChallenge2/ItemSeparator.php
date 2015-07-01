<?php

namespace ProCon;

class ItemSeparator
{
    public static function calc($n, $m, $M)
    {
        /**
         * n - m で残った数の重複のない組み合わせ
         * これを、1 - m だけ行う？
         *
         * ans = note[n][m] + note[n][m-1] + ... + note[n][1]
         * note[n][m] = note[n-m][1] + note[n-m][2] + ... + note[n-m][n-m]
         */
        $result = 0;
        $note = [];
        for ($i = 1; $i <= $m; $i++) {
            $result += ItemSeparator::getSeparatePatternNum($n, $i, $note);
        }
        return $result % $M;
    }

    private static function getSeparatePatternNum($targetNum, $separateNum, &$note)
    {
        if ($targetNum === $separateNum || $separateNum === 1) {
            return 1;
        }
        if (array_key_exists($targetNum, $note) && array_key_exists($separateNum, $note[$targetNum])) {
            return $note[$targetNum][$separateNum];
        }
        $result = 0;
        for ($i = 1; $i <= $targetNum - $separateNum; $i++) {
            $result += ItemSeparator::getSeparatePatternNum($targetNum - $separateNum, $i, $note);
        }
        $note[$targetNum][$separateNum] = $result;
        return $result;
    }
}