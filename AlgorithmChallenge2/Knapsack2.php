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

        $note = [0 => 0];
        while (list($key, $item) = each($items)) {
            $nextNote = [];
            while (list($value, $knapsackSpace) = each($note)) {
                if ($knapsackSpace + $item->weight > $knapsack) {
                    continue;
                }
                $nextValue = $value + $item->value;
                if (array_key_exists($nextValue, $note)) {
                    $nextNote[$nextValue] = min($knapsackSpace + $item->weight, $note[$nextValue]);
                    continue;
                }
                $nextNote[$nextValue] = $knapsackSpace + $item->weight;
            }
            reset($note);
            while (list($value, $weight) = each($note)) {
                if (array_key_exists($value, $nextNote) === false) {
                    $nextNote[$value] = $weight;
                }
            }
            $note = $nextNote;
        }
        reset($note);
        $result = 0;
        while (list($value, $weight) = each($note)) {
            if ($result < $value) {
                $result = $value;
            }
        }
        return $result;
    }
}