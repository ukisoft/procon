<?php

namespace ProCon;

require_once('Knapsack.php');

class NoLimitKnapsackMemoVer
{
    public static function calc($items, $knapsack)
    {
        /*
         * $memoは、荷物のvalue、weightと残りのKnapsackSpaceで一意に値が決まるようにする
         */

        $items = array_map(function($item) {
            return new Item($item[0], $item[1]);
        }, $items);

        $memo = [];
        foreach ($items as $item) {
            $memoKey = hash('sha256', (string)$item->weight . (string)$item->value . (string)$knapsack);
            $valueWithItem = NoLimitKnapsackMemoVer::add($items, $item, $knapsack - $item->weight, $memo) + $item->value;
            $valueWithoutItem = NoLimitKnapsackMemoVer::add($items, $item, $knapsack, $memo);
            $memo[$memoKey] = max($valueWithItem, $valueWithoutItem);
        }
        return max($memo);
    }

    private static function add($items, $targetItem, $knapsackSpace, &$memo)
    {
        $localMemo = [];
        foreach ($items as $item) {
            $memoKey = hash('sha256', (string)$item->weight . (string)$item->value . (string)$knapsackSpace);
            if (array_key_exists($memoKey, $memo)) {
                $localMemo[$memoKey] = $memo[$memoKey];
                continue;
            }
            if ($knapsackSpace < $item->weight) {
                $localMemo[$memoKey] = $memo[$memoKey] = 0;
                continue;
            }
            $valueWithItem = NoLimitKnapsackMemoVer::add($items, $item, $knapsackSpace - $item->weight, $memo) + $item->value;
            $valueWithoutItem = $item == $targetItem ? 0 : NoLimitKnapsackMemoVer::add($items, $item, $knapsackSpace, $memo);
            $localMemo[$memoKey] = $memo[$memoKey] = max($valueWithItem, $valueWithoutItem);
        }
        $memoKey = hash('sha256', (string)$targetItem->weight . (string)$targetItem->value . (string)$knapsackSpace);
        $memo[$memoKey] = max($localMemo);
        return $memo[$memoKey];
    }
}