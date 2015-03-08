<?php

namespace ProCon;

require_once('Knapsack.php');

class NoLimitKnapsack
{
    public static function calc($items, $knapsack)
    {
        /*
         * $noteに、itemの数だけ0を入れる
         * ナップサックの容量だけループを回す
         * 現在の容量に、itemを入れた時を計算し、$noteにあるその時の容量と比較し、大きければ更新する
         * 入らなくなれば終了
         * 全てのitemをチェックしたら、$noteにある最大の数が答え
         */

        $items = array_map(function($item) {
            return new Item($item[0], $item[1]);
        }, $items);

        $note = [];
        foreach ($items as $item) {
            for ($i = $knapsack; $i > 0; $i--) {
                $nextKnapsack = $i - $item->weight;
                if ($nextKnapsack < 0) {
                    continue 2;
                }
                if (in_array($nextKnapsack, $note) === false) {
                    $note[$nextKnapsack] = $note[$i] + $item->value;
                    continue;
                }
                $note[$nextKnapsack] = max($note[$i] + $item->value, $note[$nextKnapsack]);
            }
        }
        return max($note);
    }
}