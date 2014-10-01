<?php

namespace ProCon;

class CrazyBot {

    private static $WAY_PROBABILITIES;
    private static $MAX_N;

    private static $RESULT;

    function getProbability($n, $east, $west, $south, $north) {
        // 北に移動したと仮定する
        // 移動した場合、直前までの移動確率に掛け算する
        // nに到達したら移動停止フラグを立てる
        // その地点で今の立ち位置が、過去に通った場所であるならその場で終了
        // 移動停止フラグが立っていれば、今の時点の確率を、$resultに加える
        // そうでなければ次の移動を行う

        CrazyBot::$WAY_PROBABILITIES = [$east/100, $west/100, $south/100, $north/100];
        CrazyBot::$MAX_N = $n;
        CrazyBot::$RESULT = 0;

        $this->move([0, 0], [], 1, 1, 0);

        return CrazyBot::$RESULT;
    }

    private function move($nowPosition, $pastPositions, $nowProbability, $wayProbability, $moveCount) {
        if (in_array($nowPosition, $pastPositions)) return;

        $newProbability = $nowProbability * $wayProbability;
        if ($moveCount >= CrazyBot::$MAX_N) {
            CrazyBot::$RESULT += $newProbability;
            return;
        }

        $pastPositions[] = $nowPosition;
        $moveCount++;

        if (CrazyBot::$WAY_PROBABILITIES[0] !== 0) $this->move([$nowPosition[0] + 1, $nowPosition[1]], $pastPositions, $newProbability, CrazyBot::$WAY_PROBABILITIES[0], $moveCount);
        if (CrazyBot::$WAY_PROBABILITIES[1] !== 0) $this->move([$nowPosition[0] - 1, $nowPosition[1]], $pastPositions, $newProbability, CrazyBot::$WAY_PROBABILITIES[1], $moveCount);
        if (CrazyBot::$WAY_PROBABILITIES[2] !== 0) $this->move([$nowPosition[0], $nowPosition[1] - 1], $pastPositions, $newProbability, CrazyBot::$WAY_PROBABILITIES[2], $moveCount);
        if (CrazyBot::$WAY_PROBABILITIES[3] !== 0) $this->move([$nowPosition[0], $nowPosition[1] + 1], $pastPositions, $newProbability, CrazyBot::$WAY_PROBABILITIES[3], $moveCount);
    }
}