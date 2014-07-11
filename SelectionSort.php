<?php

namespace ProCon;

class SelectionSort
{
    static public function sortInt($array)
    {
        foreach ($array as $key => &$num) {
            if (is_numeric($num) == false) throw new InvalidArgumentException("引数の配列は、intのみ格納してください。");
            $tmp = [$key, $num];
            for ($i = $key + 1; $i < count($array); $i++) {
                if ($tmp[1] > $array[$i]) $tmp = [$i, $array[$i]];
            }
            if ($key !== $tmp[0]) {
                $array[$tmp[0]] = $num;
                $array[$key] = $tmp[1];
            }
        }
        return $array;
    }
}