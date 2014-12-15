<?php

namespace ProCon;

class FenceRepair
{
    public static function calc($boardsLength)
    {
        /**
         * 小さい数字同士を足し算する
         * 次に小さい数字同士を・・・
         * すべて足し終えた時の、これまで足し算した全ての値の合計が最小コスト
         */
        $cost = 0;
        asort($boardsLength);
        while (count($boardsLength) > 1) {
            $firstBoard = array_shift($boardsLength);
            $secondBoard = array_shift($boardsLength);
            $cost += $newBoard = $firstBoard + $secondBoard;
            $boardsLength = FenceRepair::insertNumToArrayThroughAsort($newBoard, $boardsLength);
        }
        return $cost;
    }

    private static function insertNumToArrayThroughAsort($num, $array)
    {
        foreach ($array as $key => $value) {
            if ($value >= $num) {
                array_splice($array, $key, 0, $num);
                return $array;
            }
        }
        array_push($array, $num);
        return $array;
    }
}