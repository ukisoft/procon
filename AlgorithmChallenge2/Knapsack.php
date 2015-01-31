<?php

namespace ProCon;

class Knapsack
{
    public static function calc($items, $knapsack)
    {
        $sortKey = [];
        foreach ($items as $item) {
            $sortKey[] = $item[0];
        }
        array_multisort($items, $sortKey, SORT_NUMERIC);

        $items = array_map(function($item) {
            return new Item($item[0], $item[1]);
        }, $items);

        /*
         * weightsと残りknapsack容量、noteを渡す
         * weightsの最初を取り出し、残り容量と比較する
         * 入れた時に、溢れたらスキップ
         * 溢れなかったら、入れた時の価値と、noteにある同じ残り容量の価値と比較し、大きい方をnoteに残す
         * 入れなかった場合、スキップ
         * 入れた場合、残り容量を更新し、残りweightsと残り容量を渡す
         * 延々と繰り返し、noteがどんどん更新する
         * 全てのループが終わった後のnoteの、最も大きい値が答え
         */
        $note = [(int)$knapsack => 0];
        Knapsack::add($items, (int)$knapsack, $note);
        return max($note);
    }

    private static function add($items, $knapsackSpace, &$note)
    {
        while (count($items) > 0) {
            $item = array_shift($items);
            if ($knapsackSpace < $item->weight) {
                break;
            }
            $newKnapsackSpace = $knapsackSpace - $item->weight;
            if (array_key_exists($newKnapsackSpace, $note)) {
                $note[$newKnapsackSpace] = max($note[$knapsackSpace] + $item->value, $note[$newKnapsackSpace]);
                Knapsack::add($items, $newKnapsackSpace, $note);
                continue;
            }
            $note[$newKnapsackSpace] = $note[$knapsackSpace] + $item->value;
            Knapsack::add($items, $newKnapsackSpace, $note);
        }
    }
}

class Item
{
    public function __construct($weight, $value)
    {
        $this->weight = (int)$weight;
        $this->value = (int)$value;
    }
}