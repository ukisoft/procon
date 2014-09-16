<?php

/*
 * 与えられた数の平方根を求める
 * 当然ライブラリは使わない
 */

namespace Vip;

class SquareConverter {

    static private $MAX_DIGIT = 6;

    static public function get($num)
    {
        $intSquareDigit = SquareConverter::findIntSquare($num);
        if (strlen((string)$intSquareDigit) >= SquareConverter::$MAX_DIGIT) {
            return $intSquareDigit;
        }
        $intSquareDigit = (string)$intSquareDigit . '.';
        while (true) {
            $intSquareDigit = SquareConverter::getMorePreciousSquare($num, $intSquareDigit);
            if (strlen((string)$intSquareDigit) > SquareConverter::$MAX_DIGIT) {
                return $intSquareDigit;
            }
        }
    }

    static private function findIntSquare($num)
    {
        $intSquareDigit = 0;
        while (true) {
            if ($num < $intSquareDigit * $intSquareDigit) {
                return --$intSquareDigit;
            }
            $intSquareDigit++;
        }
    }

    static private function getMorePreciousSquare($num, $previousNum)
    {
        $currentNum = 9;
        while (true) {
            $newNum = (string)$previousNum . (string)$currentNum;
            if ($num > (double)$newNum * (double)$newNum) {
                return $newNum;
            }
            $currentNum--;
        }
    }
}