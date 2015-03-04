<?php

namespace ProCon;

require_once('Knapsack.php');

class NoLimitKnapsack
{
    public static function calc($items, $knapsack)
    {
        /**
         * Knapsack問題で、毎回使った荷物を削除してたけど、それをしないようにすれば良いだけなのでは・・
         */

        $sortKey = [];
        foreach ($items as $item) {
            $sortKey[] = $item[0];
        }
        array_multisort($items, $sortKey, SORT_NUMERIC);

        $items = array_map(function($item) {
            return new Item($item[0], $item[1]);
        }, $items);

        $note = [(int)$knapsack => 0];
        NoLimitKnapsack::add($items, (int)$knapsack, $note);
        return max($note);
    }

    private static function add($items, $knapsackSpace, &$note)
    {
        foreach ($items as $item) {
            if ($knapsackSpace < $item->weight) {
                break;
            }
            $newKnapsackSpace = $knapsackSpace - $item->weight;
            if (array_key_exists($newKnapsackSpace, $note)) {
                $note[$newKnapsackSpace] = max($note[$knapsackSpace] + $item->value, $note[$newKnapsackSpace]);
                NoLimitKnapsack::add($items, $newKnapsackSpace, $note);
                continue;
            }
            $note[$newKnapsackSpace] = $note[$knapsackSpace] + $item->value;
            NoLimitKnapsack::add($items, $newKnapsackSpace, $note);
        }
    }
}