<?php

namespace ProCon;

class OverlapPattern
{
    public static function calc($n, $m, $a, $M)
    {
        /**
         * f($n, $m, $a) = f($n - 1, $m, $a[1:]) + f($n -1, $m - 1, $a[1:]) + ... + f($n -1, 0, $a[1:])
         */
        $result = 0;
        $note = [];
        $limit = array_shift($a);
        for ($i = 0; $i <= min($m, $limit); $i++) {
            $result += OverlapPattern::calcPartial($n - 1, $m - $i, $a, $M, $note) % $M;
        }
        return $result % $M;
    }

    private static function calcPartial($n, $m, $a, $M, &$note)
    {
        if ($n === 1 || $m === 0) {
            return 1;
        }
        $key = (string)$n . '_' . (string)$m;
        if (isset($note[$key])) {
            return $note[$key];
        }
        $result = 0;
        $limit = array_shift($a);
        for ($i = 0; $i <= min($m, $limit); $i++) {
            $result += OverlapPattern::calcPartial($n - 1, $m - $i, $a, $M, $note) % $M;
        }
        $note[$key] = $result % $M;
        return $note[$key];
    }
}