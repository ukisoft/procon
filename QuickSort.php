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
        $arrayNum % 2 == 0 ? $pivot = $array[(int)($arrayNum / 2)] : $pivot = $array[(int)(($arrayNum - 1) / 2)];

        $left = 0;
        $right = $arrayNum - 1;

        while (true) {
            while ($left < $arrayNum) {
                if ($array[$left] >= $pivot) break;
                $left++;
            }

            while ($right >= 0) {
                if ($array[$right] <= $pivot) break;
                $right--;
            }

            if ($left >= $right) {
                $nextArraySet = QuickSort::splitArray($array, $left);
                if (count($nextArraySet[0]) > 1) {
                    $nextArraySet[0] = QuickSort::sortParts($nextArraySet[0]);
                }
                if (count($nextArraySet[1]) > 1) {
                    $nextArraySet[1] = QuickSort::sortParts($nextArraySet[1]);
                }
                return array_merge($nextArraySet[0], $nextArraySet[1]);
            }

            $tmp = $array[$left];
            $array[$left] = $array[$right];
            $array[$right] = $tmp;

            $left++;
            $right--;
        }
    }

    static private function splitArray($array, $splitKey)
    {
        $firstArray = [];
        for ($i = 0; $i < $splitKey; $i++) {
            $firstArray[] = $array[$i];
        }
        $secondArray = [];
        for ($i = $splitKey; $i < count($array); $i++) {
            $secondArray[] = $array[$i];
        }
        return [$firstArray, $secondArray];
    }
}