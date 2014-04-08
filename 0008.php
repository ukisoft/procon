<?php

class MazeMaker {

    private static $MAP;
    private static $FOOTPRINT;
    private static $MOVE_ROW;
    private static $MOVE_COL;

    private static $ASSUMED_MAX_FOOTPRINT_COUNT;

    public function longestPath($maze, $startRow, $startCol, $moveRow, $moveCol) {

        // 前準備
        MazeMaker::$MAP = [];
        MazeMaker::$FOOTPRINT = [];
        MazeMaker::$MOVE_ROW = $moveRow;
        MazeMaker::$MOVE_COL = $moveCol;

        MazeMaker::$ASSUMED_MAX_FOOTPRINT_COUNT = 100; // 仮置き

        foreach ($maze as $row) {
            $mapRow = str_split($row);
            MazeMaker::$MAP[] = $mapRow;
            MazeMaker::$FOOTPRINT[] = array_fill(0, count($mapRow), MazeMaker::$ASSUMED_MAX_FOOTPRINT_COUNT);
        }

        // 移動
        for ($i = 0; $i < count(MazeMaker::$MOVE_ROW); $i++) {
            $this->move($startRow, $startCol, MazeMaker::$MOVE_ROW[$i], MazeMaker::$MOVE_COL[$i], 1);
        }


        $result = -1;

        for ($i = 0; $i < count(MazeMaker::$MAP); $i++) {
            for ($j = 0; $j < count(MazeMaker::$MAP[0]); $j++) {
                if ($i === $startRow && $j === $startCol && MazeMaker::$FOOTPRINT[$i][$j] === MazeMaker::$ASSUMED_MAX_FOOTPRINT_COUNT) {
                    $result = max([$result, 0]); // スタート地点に戻れない、且つそこにゴールがある場合
                    continue;
                }
                if (MazeMaker::$MAP[$i][$j] === '.' && MazeMaker::$FOOTPRINT[$i][$j] === MazeMaker::$ASSUMED_MAX_FOOTPRINT_COUNT) return -1; // 行けない場所があれば-1
                if (MazeMaker::$FOOTPRINT[$i][$j] === MazeMaker::$ASSUMED_MAX_FOOTPRINT_COUNT) continue; // 進入不可の場所
                $result = max([$result, MazeMaker::$FOOTPRINT[$i][$j]]);
            }
        }

        return $result;
    }

    private function move($standPositionX, $standPositionY, $moveDistanceX, $moveDistanceY, $nextMoveCount) {
        $nextPositionX = $standPositionX + $moveDistanceX;
        $nextPositionY = $standPositionY + $moveDistanceY;

        if (array_key_exists($nextPositionX, MazeMaker::$MAP) === false) return; // MAP外
        if (array_key_exists($nextPositionY, MazeMaker::$MAP[$nextPositionX]) === false) return; // MAP外
        if (MazeMaker::$MAP[$nextPositionX][$nextPositionY] === 'X') return; // 進入不可
        if (MazeMaker::$FOOTPRINT[$nextPositionX][$nextPositionY] <= $nextMoveCount) return; // 他に最短経路有り

        MazeMaker::$FOOTPRINT[$nextPositionX][$nextPositionY] = $nextMoveCount;
        $nextMoveCount++;

        for ($i = 0; $i < count(MazeMaker::$MOVE_ROW); $i++) {
            $this->move($nextPositionX, $nextPositionY, MazeMaker::$MOVE_ROW[$i], MazeMaker::$MOVE_COL[$i], $nextMoveCount);
        }
    }
}