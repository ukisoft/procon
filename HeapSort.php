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
        while (++$i < count($array)) { // 一度、ヒープの条件を満たした配列を作る
            HeapSort::upHeap($array, $i);
        }

        while (--$i > 0) { // 最大の値を最後の値と入れ替え、再度ヒープ条件を満たす配列を作る
            HeapSort::swap($array, 0, $i);
            HeapSort::downHeap($array, $i);
        }

        return $array;
    }

    static private function upHeap(&$array, $n)
    {
        while ($n > 0) {
            $m = (int)(($n + 1) / 2 - 1);
            if ($array[$m] < $array[$n]) {
                HeapSort::swap($array, $n, $m);
            } else {
                break;
            }
            $n = $m;
        }
    }

    static private function downHeap(&$array, $n)
    {
        $m = $tmp = 0;
        while (true) {
            $leftChild = (int)(($m + 1) * 2 - 1);
            $rightChild = (int)(($m + 1) * 2);

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
}
