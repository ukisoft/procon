<?php

namespace ProCon;

class QuickSort
{
    static public function sortInt($array)
    {
        foreach ($array as $num) {
            if (is_numeric($num) == false) throw new InvalidArgumentException("引数の配列は、intのみ格納してください。");
        }

        return QuickSort::sortParts($array);
    }

    static private function sortParts($array)
    {
        $arrayNum = count($array);
        $arrayNum % 2 == 0 ? $pivotKey = (int)($arrayNum / 2) : $pivotKey = (int)(($arrayNum - 1) / 2);
        $pivotValue = $array[$pivotKey];

        for ($i = 0; $i < $pivotKey; $i++) {
            if ($array[$i] >= $pivotValue) {
                for ($j = $arrayNum - 1; $j >= $pivotKey; $j--) {
                    if ($array[$j] <= $pivotValue) {
                        $tmpValue = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tmpValue;
                        if ($j == $pivotKey) {
                            $pivotKey = $i;
                        }
                    }
                }
            }
        }

        for ($j = $arrayNum - 1; $j > $pivotKey; $j--) {
            if ($array[$j] < $pivotValue) {
                for ($i = 0; $i <= $pivotKey; $i++) {
                    if ($array[$i] >= $pivotValue) {
                        $tmpValue = $array[$i];
                        $array[$i] = $array[$j];
                        $array[$j] = $tmpValue;
                        if ($i == $pivotKey) {
                            $pivotKey = $j;
                        }
                    }
                }
            }
        }

        $nextArraySet = QuickSort::splitArray($array, $pivotKey);
        if (count($nextArraySet[0]) > 1) {
            $nextArraySet[0] = QuickSort::sortParts($nextArraySet[0]);
        }
        if (count($nextArraySet[1]) > 1) {
            $nextArraySet[1] = QuickSort::sortParts($nextArraySet[1]);
        }

        return array_merge($nextArraySet[0], [$pivotValue], $nextArraySet[1]);
    }

    static private function splitArray($array, $splitKey)
    {
        $firstArray = [];
        for ($i = 0; $i < $splitKey; $i++) {
            $firstArray[] = $array[$i];
        }
        $secondArray = [];
        for ($i = $splitKey + 1; $i < count($array); $i++) {
            $secondArray[] = $array[$i];
        }
        return [$firstArray, $secondArray];
    }
}