<?php

namespace ProCon;

class PartialSumChecker
{
    static public function check($subjects, $sumTarget)
    {
        $patterns = PartialSumChecker::getPattern(count($subjects));
        foreach ($patterns as $pattern) {
            if (PartialSumChecker::sumPartially($subjects, $pattern) === $sumTarget) {
                return true;
            }
        }
        return false;
    }

    static private function getPattern($bitNum)
    {
        $format = "%0{$bitNum}b";
        $result = [];
        for ($i = 0; $i < 2 ** $bitNum; $i++) {
            $result[] = sprintf($format, $i);
        }
        return $result;
    }

    static private function sumPartially($subjects, $pattern)
    {
        $sum = 0;
        foreach (str_split($pattern) as $key => $bit) {
            if ($bit === "1") {
                $sum += $subjects[$key];
            }
        }
        return $sum;
    }
}