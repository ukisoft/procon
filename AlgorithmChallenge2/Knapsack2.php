<?php

namespace ProCon;

require_once('Knapsack.php');

class Knapsack2
{
    public static function calc($items, $knapsack)
    {
        $items = array_map(function($item) {
            return new Item($item[0], $item[1]);
        }, $items);

        $note = [(int)$knapsack => 0];
        while (list($key, $item) = each($items)) {
            $nextNote = [];
            while (list($knapsackSpace, $value) = each($note)) {
                $nextKnapsackSpace = $knapsackSpace - $item->weight;
                if ($nextKnapsackSpace < 0) {
                    continue;
                }
                if (array_key_exists($nextKnapsackSpace, $note)) {
                    $nextNote[$nextKnapsackSpace] = max($value + $item->value, $note[$nextKnapsackSpace]);
                    continue;
                }
                $nextNote[$nextKnapsackSpace] = $value + $item->value;
            }
            reset($note);
            while (list($key, $value) = each($note)) {
                if (array_key_exists($key, $nextNote) === false) {
                    $nextNote[$key] = $value;
                }
            }
            $note = $nextNote;
        }
        return max($note);
    }
}