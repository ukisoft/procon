<?php

class MazeMaker {

    private $MAP;
    private $FOOTPRINT;
    private $QUEUE_STORE;

    public function longestPath($maze, $startRow, $startCol, $moveRow, $moveCol) {

        // mapを作る
        // スタート地点に0を入れる
        // 移動をキューに入れる
        // 移動をして、移動先が'X'、map外、もしくはfootprintに値があれば、終了
        // 上記以外であれば、今のfootprintの値を書き込み、次の移動をキューに入れ終了
        // 全てのキューがなくなったとき、mapが'.'で、footprintに値が入ってなければ、-1を返す
        // 上記がなければ、最も大きい値を返す

        foreach ($maze as $mapRow) $this->MAP[] = str_split($mapRow);
        $this->QUEUE_STORE = new SplQueue();

        $this->FOOTPRINT[$startRow][$startCol] = 0;
        array_map(function($moveX, $moveY) use ($startRow, $startCol) {
            $this->QUEUE_STORE->enqueue(['nowX' => $startRow, 'nowY' => $startCol, 'moveX' => $moveX, 'moveY' => $moveY, 'nextStep' => 1]);
        }, $moveRow, $moveCol);

        foreach ($this->QUEUE_STORE as $queue) {
            $nextX = $queue['nowX'] + $queue['moveX'];
            $nextY = $queue['nowY'] + $queue['moveY'];
            if (array_key_exists($nextX, $this->MAP) === false) continue;
            if (array_key_exists($nextY, $this->MAP[$nextX]) === false) continue;
            if ($this->MAP[$nextX][$nextY] === 'X') continue;
            if (isset($this->FOOTPRINT[$nextX][$nextY])) continue;
            $this->FOOTPRINT[$nextX][$nextY] = $queue['nextStep'];
            array_map(function($moveX, $moveY) use ($nextX, $nextY, $queue) {
                $this->QUEUE_STORE->enqueue(['nowX' => $nextX, 'nowY' => $nextY, 'moveX' => $moveX, 'moveY' => $moveY, 'nextStep' => $queue['nextStep'] + 1]);
            }, $moveRow, $moveCol);
        }

        $result = 0;
        foreach ($this->MAP as $mapX => $mapRow) {
            foreach ($mapRow as $mapY => $position) {
                if ($position === 'X') continue;
                if ($position === '.') {
                    if (array_key_exists($mapX, $this->FOOTPRINT) === false) return -1;
                    if (array_key_exists($mapY, $this->FOOTPRINT[$mapX]) === false) return -1;
                }
                if ($result < $this->FOOTPRINT[$mapX][$mapY]) $result = $this->FOOTPRINT[$mapX][$mapY];
            }
        }
        return $result;
    }
}