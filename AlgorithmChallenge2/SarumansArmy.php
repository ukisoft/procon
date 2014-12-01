<?php

namespace ProCon;

class SarumansArmy
{
    public static function calc($radius, $positions)
    {
        /**
         * 一番小さい値から、半径の範囲内で、最も遠い位置を探す（１
         * その位置から半径の範囲に入らず、且つ最も小さい位置を探す（２
         * 範囲外の位置が残っていなければ終了
         * あれば（１）から繰り返す
         */
        $count = 0;
        while (count($positions) > 0) {
            $smallSidePosition = min($positions);
            $centerPosition = max(array_filter($positions, function($position) use ($smallSidePosition, $radius) {
                if ($position <= $smallSidePosition + $radius) {
                    return $position;
                }
            }));
            $restPositions = array_filter($positions, function($position) use ($centerPosition, $radius) {
                if ($position > $centerPosition + $radius) {
                    return $position;
                }
            });
            $positions = $restPositions;
            $count++;
        }

        return $count;
    }
}