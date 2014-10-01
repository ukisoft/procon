<?php

namespace ProCon;

class HamiltonPath
{
    static public function countPaths($roads)
    {
        /*
         * 1つの都市から、3以上の必須経路が伸びていれば、return 0
         * ループが発生する場合も、return 0
         * 1〜2つ経路が伸びていれば、それを1つの都市として扱う
         *
         * 上記の場合の都市数の階乗を求める
         * 1つの都市として考えた場合、方向が2通りあるため、まとめた数だけ2をかける
         */

        $parsedRoads = array_map(function($road) {
            return str_split($road);
        }, $roads);

        if (HamiltonPath::hasOverThreeNecessaryPathsInOneCity($parsedRoads)) return 0;
        if (HamiltonPath::hasLoopPath($parsedRoads)) return 0;

        $necessaryPathNumWithoutChains = HamiltonPath::countNecessaryPathWithoutChains($parsedRoads);
        $necessaryPathNum = HamiltonPath::countNecessaryPath($parsedRoads);
        $pathNum = count($parsedRoads);

        $result = 1;
        for ($i = $pathNum - $necessaryPathNum; $i > 0; $i--) {
            $result *= $i;
        }
        return $result * pow(2, $necessaryPathNumWithoutChains);
    }

    static private function hasOverThreeNecessaryPathsInOneCity($parsedRoads)
    {
        foreach ($parsedRoads as $parsedRoad) {
            $necessaryPathNum = 0;
            foreach ($parsedRoad as $path) {
                if ($path == 'Y') $necessaryPathNum++;
                if ($necessaryPathNum >= 3) return true;
            }
        }
        return false;
    }

    static private function hasLoopPath($parsedRoads)
    {
        $loopPathNote = [];
        for ($i = 0; $i < count($parsedRoads); $i++) {
            $loopPathNote[] = HamiltonPath::findLoopPath($parsedRoads, $i, $i);
        }
        return in_array(true, $loopPathNote);
    }

    static private function findLoopPath($parsedRoads, $startCheckPathNum, $currentCheckPathNum, $pastCheckPathNum = -1)
    {
        foreach ($parsedRoads[$currentCheckPathNum] as $cityNum => $path) {
            if ($path == 'Y') {
                if ($cityNum == $pastCheckPathNum) continue;
                if ($pastCheckPathNum != -1 && $cityNum == $startCheckPathNum) return true;
                if (HamiltonPath::findLoopPath($parsedRoads, $startCheckPathNum, $cityNum, $currentCheckPathNum)) return true;
            }
        }
        return false;
    }

    static private function countNecessaryPathWithoutChains($parsedRoads)
    {
        $necessaryPathNum = 0;
        foreach ($parsedRoads as $parsedRoad) {
            $necessaryPathNumInOneCity = 0;
            foreach ($parsedRoad as $path) {
                if ($path == 'Y') $necessaryPathNumInOneCity++;
            }
            if ($necessaryPathNumInOneCity == 1) $necessaryPathNum++;
        }
        return $necessaryPathNum / 2;
    }

    static private function countNecessaryPath($parsedRoads)
    {
        $necessaryPathNum = 0;
        foreach ($parsedRoads as $parsedRoad) {
            foreach ($parsedRoad as $path) {
                if ($path == 'Y') $necessaryPathNum++;
            }
        }
        return $necessaryPathNum / 2;
    }
}