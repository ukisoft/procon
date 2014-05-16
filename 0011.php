<?php

namespace Procon;

class BadNeighbors
{
    private $donations;

    public function maxDonations($donations)
    {
        // [['0100' => 5], ['0101' => 8]...]

        // bit演算でパターン作る
        // foreachで回す
        // 隣人チェックで隣になったパターンをフィルタする
        // foreachでcalcDonationを呼ぶ
        // 計算したdonationは、メモに格納する
        $this->donations = $donations;
        $numberOfPeople = count($donations);
        $result = [];
        for ($i = 0; $i < pow(2, $numberOfPeople); $i++) {
            $pattern = sprintf('%0' . (String)$numberOfPeople . 'b', $i);
            if (preg_match('/^1[01]*1$|11/', $pattern) === 0) {
                $result[] = $this->calcDonation($pattern);
            }
        }

        return max($result);
    }

//    private function makePatterns($numberOfPeople)
//    {
//        if ($numberOfPeople === 1) {
//            return ['0', '1'];
//        }
//
//        $patterns = [];
//        foreach ($this->makePatterns($numberOfPeople - 1) as $pattern) {
//            $patterns[] = '0' . $pattern;
//            $patterns[] = $pattern . '0';
//        }
//        return $patterns;
//    }

    private function calcDonation($pattern)
    {
        // keyの1の数が1つだったら計算する
        // 2つ以上だったら、一番右側にある1を0にしたパターンを探し、値をとってきて、donationを計算する
        // 値がない場合は、再帰的に探し続ける
        $result = 0;
        foreach (str_split($pattern) as $peopleNo => $donationFlg) {
            if ($donationFlg === '1') {
                $result += $this->donations[$peopleNo];
            }
        }

        return $result;
    }
}