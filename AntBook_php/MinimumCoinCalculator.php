<?php

namespace ProCon;

class MinimumCoinCalculator
{
    public static function get($coin1, $coin5, $coin10, $coin50, $coin100, $coin500, $payment)
    {
        $coinHolder = [1 => $coin1, 5 => $coin5, 10 => $coin10, 50 => $coin50, 100 => $coin100, 500 => $coin500];
        krsort($coinHolder);

        $result = 0;
        foreach ($coinHolder as $coinValue => $coinNum) {
            $additionalCoinNum = min($coinNum, (int)($payment / $coinValue));
            $payment -= $coinValue * $additionalCoinNum;
            $result += $additionalCoinNum;
            if ($payment === 0) {
                return $result;
            }
        }
        throw new \DomainException('割りきれませんでした。');
    }
}