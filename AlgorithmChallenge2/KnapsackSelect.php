<?php

namespace ProCon;

class KnapsackSelect
{
    public static function calc($items, $rate)
    {
        /**
         * 【問題】
         * 番号のついた荷物があり、それぞれ値段がついている。
         * 全ての荷物の値段の合計の30（±5）%となる、荷物の組み合わせを求めよ（最も30％に近い組み合わせ？）。
         * また、荷物の数は50-100個の範囲内とする。
         */

        $note = [];
        $note[0] = [0];
        $note[0]['0'] = [];
        $target = array_sum($items) * ($rate / 100);
        $upperTarget = array_sum($items) * (($rate + 5) / 100);

        foreach ($items as $id => $value) {
            foreach ($note as &$sums) {
                foreach ($sums as $sum => $idList) {
                    $newSum = (float)$sum + $value;
                    if ($newSum > $upperTarget) {
                        continue;
                    }
                    if (array_key_exists((string)$newSum, $sums)) {
                        continue;
                    }
                    if (in_array($id, $idList)) {
                        continue;
                    }
                    $sums[(string)$newSum] = array_unique(array_merge($idList, [$id]));
                }
            }
        }

        $resultSum = 0;
        $resultIdList = [];
        foreach ($note as $sums) {
            foreach ($sums as $sum => $idList) {
                if (abs($resultSum - $target) > abs((float)$sum - $target)) {
                    $resultSum = $sum;
                    $resultIdList = $idList;
                }
            }
        }

        return [$resultSum, $resultIdList];
    }
}