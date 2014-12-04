<?php

namespace ProCon;

class FenceRepair
{
    public static function calc($boardsLength)
    {
        /**
         * 長いものから切り取っていけば良い？
         */
        $cost = 0;
        rsort($boardsLength);
        while (count($boardsLength) > 1) {
            $cost += array_sum($boardsLength);
            array_shift($boardsLength);
        }
        return $cost;
    }
}