<?php

namespace ProCon;

class CirclesCountry {

    public function leastBorders($x, $y, $r, $x1, $y1, $x2, $y2)
    {
        /*
         * スタート地点が、どのサークルに含まれているか求める
         * ゴール地点が、どのサークルに含まれているか求める
         * 上記から、両方に含まれているサークルを取り除く
         *
         * 各サークルデータをLoopさせ、スタートとゴールに含まれているかどうかを判断する
         * サークルの中心から各地点への距離が、半径よりも小さければ含まれている、大きければ含まれていない
         */

        $circleJudge = array_map(function($oneX, $oneY, $oneR) use ($x1, $y1, $x2, $y2) {
            $judge = [];
            (pow(($oneX - $x1), 2) + pow(($oneY - $y1), 2) < pow($oneR, 2)) ? $judge[] = 1 : $judge[] = 0;
            (pow(($oneX - $x2), 2) + pow(($oneY - $y2), 2) < pow($oneR, 2)) ? $judge[] = 1 : $judge[] = 0;
            return $judge;
        }, $x, $y, $r);

        $result = 0;
        foreach ($circleJudge as $oneJudge) {
            if ($oneJudge[0] + $oneJudge[1] == 1) $result++;
        }
        return $result;
    }
}