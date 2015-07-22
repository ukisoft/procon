<?php

namespace ProCon;

class ItemSeparatorVer2
{
    public static function calc($n, $m, $M)
    {
        /**
         * f(n, m) = f(n, m -1) + f(n - m, min(n - m, m))
         */
        $note = [];
        return ItemSeparatorVer2::getSeparatePatternNum($n, $m, $M, $note);
    }

    private static function getSeparatePatternNum($targetNum, $separateNum, $M, &$note)
    {
        if ($targetNum === 0 || $separateNum === 1) {
            return 1;
        }
        if (isset($note[$targetNum][$separateNum])) {
            return $note[$targetNum][$separateNum];
        }
        $ev1 = ItemSeparatorVer2::getSeparatePatternNum($targetNum, $separateNum - 1, $M, $note);
        $ev2 = ItemSeparatorVer2::getSeparatePatternNum($targetNum - $separateNum, min($targetNum - $separateNum, $separateNum), $M, $note);
        $note[$targetNum][$separateNum] = ($ev1 + $ev2) % $M;
        return ($ev1 + $ev2) % $M;
    }
}