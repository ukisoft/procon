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
        $heap = new \SplPriorityQueue();
        foreach ($boardsLength as $boardLength) {
            $heap->insert($boardLength, 1 / $boardLength);
        }
        while ($heap->count() > 1) {
            $firstBoard = $heap->extract();
            $secondBoard = $heap->extract();
            $cost += $newBoard = $firstBoard + $secondBoard;
            $heap->insert($newBoard, 1 / $newBoard);
        }
        return $cost;
    }
}