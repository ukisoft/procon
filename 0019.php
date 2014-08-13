<?php

namespace ProCon;

class HamiltonPath
{
    static public function countPaths($roads)
    {
        /*
         * 1つの都市から、3以上の必須経路が伸びていれば、return 0
         * すべての経路を通る必要がある場合も、return 0
         * 2つ経路が伸びていれば、それを1つの都市として扱う
         * 1つの経路の場合、そのまま
         *
         * 上記の場合の都市数の階乗を求める
         * 1つの都市として考えた場合、方向が2通りあるため、まとめた数だけ2をかける
         */

        $parsedRoads = array_map(function($road) {
            return str_split($road);
        }, $roads);

        if (HamiltonPath::hasOverThreeNecessaryPathsInOneCity($parsedRoads)) return 0;
        if (HamiltonPath::hasNoUnnecessaryPath($parsedRoads)) return 0;

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

    static private function hasNoUnnecessaryPath($parsedRoads)
    {
        $unnecessaryPathNum = 0;
        foreach ($parsedRoads as $parsedRoad) {
            foreach ($parsedRoad as $path) {
                if ($path == 'N') $unnecessaryPathNum++;
            }
        }
        return $unnecessaryPathNum == count($parsedRoads);
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