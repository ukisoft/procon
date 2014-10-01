<?php

namespace ProCon;

class LakeCounter
{
    const CHECK = 'x';

    static public function get($lakes)
    {
        $area = new Area($lakes);
        $checkSheet = LakeCounter::getBlankStringArray($area->getMaxRowNum(), $area->getMaxColumnNum());
        return LakeCounter::countLakes($area, $checkSheet);
    }

    static private function getBlankStringArray($rowNum, $columnNum)
    {
        $rowArray = [];
        for ($j = 0; $j < $rowNum; $j++) {
            $rowArray[] = '';
        }

        $result = [];
        for ($i = 0; $i < $columnNum; $i++) {
            $result[] = $rowArray;
        }

        return $result;
    }

    /**
     * @param Area $area
     * @param array $checkSheet
     * @return int
     */
    static private function countLakes($area, $checkSheet)
    {
        $result = 0;
        for ($i = 0; $i < $area->getMaxRowNum(); $i++) {
            for ($j = 0; $j < $area->getMaxColumnNum(); $j++) {
                if ($area->isDryLand($i, $j)) {
                    $checkSheet[$i][$j] = LakeCounter::CHECK;
                    continue;
                }
                if ($checkSheet[$i][$j] !== LakeCounter::CHECK) {
                    $result++;
                    $checkSheet[$i][$j] = LakeCounter::CHECK;
                }
                $checkSheet = LakeCounter::checkConnectedLakes($i, $j, $area, $checkSheet);
            }
        }
        return$result;
    }

    /**
     * @param int $x
     * @param int $y
     * @param Area $area
     * @param array $checkSheet
     * @return array
     */
    static private function checkConnectedLakes($x, $y, $area, $checkSheet)
    {
        $checkArea = [[$x - 1, $y - 1], [$x - 1, $y], [$x - 1, $y + 1],
            [$x, $y - 1], [$x, $y + 1],
            [$x + 1, $y - 1], [$x + 1, $y], [$x + 1, $y + 1]];

        foreach ($checkArea as $checkPoint) {
            if ($area->isAvailable($checkPoint[0], $checkPoint[1]) && $area->isLake($checkPoint[0], $checkPoint[1])) {
                $checkSheet[$checkPoint[0]][$checkPoint[1]] = LakeCounter::CHECK;
            }
        }
        return $checkSheet;
    }
}

class Area
{
    const LAKE = 'W';
    const DRY_LAND = '.';

    function __construct($lakes)
    {
        $this->areaMap = $this->parseLakes($lakes);
        $this->maxRow = count($this->areaMap);
        $this->maxColumn = count($this->areaMap[0]);
    }

    private function parseLakes($lakes)
    {
        $result = [];
        foreach ($lakes as $lake) {
            $result[] = str_split($lake);
        }
        return $result;
    }

    function getMaxRowNum()
    {
        return $this->maxRow;
    }

    function getMaxColumnNum()
    {
        return $this->maxColumn;
    }

    function isDryLand($x, $y)
    {
        return $this->areaMap[$x][$y] === Area::DRY_LAND;
    }

    function isLake($x, $y)
    {
        return $this->areaMap[$x][$y] === Area::LAKE;
    }

    function isAvailable($x, $y)
    {
        if ($x < 0) {
            return false;
        }
        if ($x >= $this->maxRow) {
            return false;
        }
        if ($y < 0) {
            return false;
        }
        if ($y >= $this->maxColumn) {
            return false;
        }
        return true;
    }
}