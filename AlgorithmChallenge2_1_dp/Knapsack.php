<?php

namespace ProCon;

class Knapsack
{
    public static function calc($items, $knapsack)
    {
        /*
         * $noteに、ナップサックの容量をkeyとして、valueに0を入れる
         * $noteの数だけループを回す
         * 現在の容量に、itemを入れた時を計算し、$noteにあるその時の容量と比較し、大きければ更新する
         * 入らなければスキップ
         * 全てのitemをチェックしたら、$noteにある最大の数が答え
         */

        $items = array_map(function($item) {
            return new Item($item[0], $item[1]);
        }, $items);

        $note = [(int)$knapsack => 0];
        foreach ($items as $item) {
            $nextNote = [];
            foreach ($note as $knapsackSpace => $value) {
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
            $note = $nextNote + $note;
        }
        return max($note);
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