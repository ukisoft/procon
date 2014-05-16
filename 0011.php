<?php

namespace Procon;

class BadNeighbors
{
    private $donations;
    private $memo;

    public function maxDonations($donations)
    {
        // [['0100' => 5], ['0101' => 8]...]

        // bit演算でパターン作る
        // foreachで回す
        // 隣人チェックで隣になったパターンをフィルタする
        // foreachでcalcDonationを呼ぶ
        // 計算したdonationは、メモに格納する

        $this->donations = $donations;
        $this->memo = [];
        $numberOfPeople = count($donations);
        $patterns = [];

        for ($i = 1; $i < pow(2, $numberOfPeople); $i++) {
            $pattern = sprintf('%0' . (String)$numberOfPeople . 'b', $i);
            if (preg_match('/^1[01]*1$|11/', $pattern) === 0) {
                $patterns[] = $pattern;
            }
        }

        $result = [];
        foreach ($patterns as $pattern) {
            $result[] = $this->calcDonation($pattern);
        }

        return max($result);
    }

    private function calcDonation($pattern)
    {
        if (array_key_exists($pattern, $this->memo)) {
            return $this->memo[$pattern];
        }
        $firstOnePosition = strpos($pattern, '1');
        if (array_sum(str_split($pattern)) === 1) {
            $donation = $this->donations[$firstOnePosition];
            $this->memo[$pattern] = $donation;
            return $donation;
        }
        $donation = $this->calcDonation(substr($pattern, 0, $firstOnePosition) . '0' . substr($pattern, $firstOnePosition + 1)) + $this->donations[$firstOnePosition];
        $this->memo[$pattern] = $donation;
        return $donation;
    }
}