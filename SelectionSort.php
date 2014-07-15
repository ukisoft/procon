<?php

namespace ProCon;

class SelectionSort
{
    static public function sortInt($array)
    {
        foreach ($array as $key => &$num) {
            if (is_numeric($num) == false) throw new InvalidArgumentException("引数の配列は、intのみ格納してください。");
            $minKey = $key;
            $minNum = $num;
            for ($i = $key + 1; $i < count($array); $i++) {
                if ($minNum > $array[$i]) {
                    $minKey = $i;
                    $minNum = $array[$i];
                }
            }
            $array[$minKey] = $num;
            $array[$key] = $minNum;
        }
        return $array;
    }
}