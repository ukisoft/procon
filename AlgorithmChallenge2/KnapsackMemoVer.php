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

        $memo = [];
        return KnapsackMemoVer::add($items, 0, $knapsack, $memo);
    }

    private static function add($items, $index, $knapsackSpace, &$memo)
    {
        if ($index >= count($items)) {
            return 0;
        }
        $memoKey = hash('sha256', (string)$index . (string)$knapsackSpace);
        if (array_key_exists($memoKey, $memo)) {
            return $memo[$memoKey];
        }
        if ($knapsackSpace < $items[$index]->weight) {
            return 0;
        }
        $valueWithIndexItem = KnapsackMemoVer::add($items, $index + 1, $knapsackSpace - $items[$index]->weight, $memo) + $items[$index]->value;
        $valueWithoutIndexItem = KnapsackMemoVer::add($items, $index + 1, $knapsackSpace, $memo);
        $memo[$memoKey] = max($valueWithIndexItem, $valueWithoutIndexItem);
        return $memo[$memoKey];
    }
}