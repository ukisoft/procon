<?php

namespace ProCon;

class KnapsackMemoVer
{
    public static function calc($items, $knapsack)
    {
        /*
         * $memoは、荷物のindexと残りのKnapsackSpaceで一意に値が決まるようにする
         */

        $items = array_map(function($item) {
            return new Item($item[0], $item[1]);
        }, $items);
        sort($items);  // array_mapの作る配列のindexは、元になる配列のindexに依存するため、ソートして0から始まるようにする。

        $memo = [];
        return KnapsackMemoVer::add($items, 0, $knapsack, $memo);
    }

    private static function add($items, $index, $knapsackSpace, &$memo)
    {
        if ($index >= count($items)) {
            return 0;
        }
        $memoKey = hash('sha256', (string)$index . '-' . (string)$knapsackSpace);
        if (isset($memo[$memoKey])) {
            return $memo[$memoKey];
        }
        if ($knapsackSpace < $items[$index]->weight) {
            $memo[$memoKey] = KnapsackMemoVer::add($items, $index + 1, $knapsackSpace, $memo);
            return $memo[$memoKey];
        }
        $valueWithIndexItem = KnapsackMemoVer::add($items, $index + 1, $knapsackSpace - $items[$index]->weight, $memo) + $items[$index]->value;
        $valueWithoutIndexItem = KnapsackMemoVer::add($items, $index + 1, $knapsackSpace, $memo);
        $memo[$memoKey] = max($valueWithIndexItem, $valueWithoutIndexItem);
        return $memo[$memoKey];
    }
}