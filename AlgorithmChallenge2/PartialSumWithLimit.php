<?php

namespace ProCon;

class PartialSumWithLimit
{
    public static function calc($a, $m, $k)
    {
        $dp = [$k];
        for ($i = 0; $i < count($a); $i++) {
            for ($j = 0; $j < $m[$i]; $j++) {
                $restCount = count($dp);
                for ($l = 0; $l < $restCount; $l++) {
                    $nextRest = $dp[$l] - $a[$i];
                    if ($nextRest === 0) {
                        return true;
                    }
                    if ($nextRest < 0) {
                        continue;
                    }
                    if (in_array($nextRest, $dp)) {
                        continue;
                    }
                    $dp[] = $nextRest;
                }
            }
        }
        return false;
    }
}