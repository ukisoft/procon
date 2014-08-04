<?php

namespace ProCon;

class HeapSort
{
    static public function sortInt($array)
    {
        foreach ($array as $num) {
            if (is_numeric($num) == false) throw new InvalidArgumentException("引数の配列は、intのみ格納してください。");
        }

        $i = 0;
        while (++$i < count($array)) {
            HeapSort::upHeap($array, $i);
        }

        while (--$i > 0) {
            HeapSort::swap($array, 0, $i);
            HeapSort::downHeap($array, $i);
        }

        return $array;
    }

    static private function upHeap(&$array, $n)
    {
        while ($n > 0) {
            $m = (int)(($n + 1) / 2 - 1);
            if ($array[$m] >= $array[$n]) {
                break;
            }
            HeapSort::swap($array, $n, $m);
            $n = $m;
        }
    }

    static private function downHeap(&$array, $n)
    {
        $m = $tmp = 0;
        while (true) {
            $leftChild = (int)(($n + 1) * 2 - 1);
            $rightChild = (int)(($n + 1) * 2);

            if ($leftChild >= $n) {
                break;
            }

            if ($array[$leftChild] > $array[$tmp]) {
                $tmp = $leftChild;
            }
            if ($rightChild < $n && $array[$rightChild] > $array[$tmp]) {
                $tmp = $rightChild;
            }

            if ($tmp == $m) {
                break;
            }
            HeapSort::swap($array, $tmp, $m);
            $m = $tmp;
        }
    }

    static private function swap(&$array, $i, $j)
    {
        $tmp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $tmp;
    }

//    static public function sortInt($array)
//    {
//        foreach ($array as $num) {
//            if (is_numeric($num) == false) throw new InvalidArgumentException("引数の配列は、intのみ格納してください。");
//        }
//
//        array_unshift($array, 'dummy');
//        for ($i = 1; $i < count($array); $i++) {
//            $array = HeapSort::sortParts($array, $i);
//        }
//        array_shift($array);
//        return $array;
//    }
//
//    static private function sortParts($array, $start)
//    {
//        $isFinishedToSwitch = false;
//        $arrayNum = count($array);
//        while ($isFinishedToSwitch == false) {
//            $isFinishedToSwitch = true;
//            for ($i = $start; $i < $arrayNum; $i++) {
//                if ($i * 2 >= $arrayNum) break;
//                if (($i * 2) + 1 < $arrayNum && $array[$i * 2] < $array[$i]) {
//                    $tmp = $array[$i * 2];
//                    $array[$i * 2] = $array[$i];
//                    $array[$i] = $tmp;
//                    $isFinishedToSwitch = false;
//                }
//                elseif (($i * 2) + 1 < $arrayNum && min($array[$i * 2], $array[($i * 2) + 1]) < $array[$i]) {
//                    if ($array[$i * 2] < $array[($i * 2) + 1]) {
//                        $tmp = $array[$i * 2];
//                        $array[$i * 2] = $array[$i];
//                        $array[$i] = $tmp;
//                        $isFinishedToSwitch = false;
//                    }
//                    else {
//                        $tmp = $array[($i * 2) + 1];
//                        $array[($i * 2) + 1] = $array[$i];
//                        $array[$i] = $tmp;
//                        $isFinishedToSwitch = false;
//                    }
//                }
//            }
//        }
//        $last = $array[$arrayNum - 1];
//        array_splice($array, $start + 1, 0, $last);
//        array_pop($array);
//        return $array;
//    }
}
