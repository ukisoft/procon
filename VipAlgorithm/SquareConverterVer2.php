<?php

namespace ProCon;

class SquareConverterVer2
{
    static private $maxCalcCount = 10000;
    static private $epsilon = 0.000000001;

    static public function get($num)
    {
        if ($num < 0) {
            throw new \DomainException('0より大きい値である必要があります。');
        }
        if ($num === 0) {
            return 0;
        }

        $oldX = $num;
        for ($i = 0; $i < SquareConverterVer2::$maxCalcCount; $i++) {
            $newX = ($oldX + $num / $oldX) / 2;
            if (abs($oldX - $newX) < SquareConverterVer2::$epsilon) {
                return round($newX, 5);
            }
            $oldX = $newX;
        }
        throw new \DomainException('収束しませんでした。');
    }
}