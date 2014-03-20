<?php

class InterestingDigits {

    public function digits($base) {
        // 4桁未満の数字を用意する
        // 特定の数をかける
        // baseの基数に変換する
        // 積の各桁を合計する
        // その結果が特定の数で割れれば処理を継続、そうでなければ次の値
        // 桁数が4桁を超えるまで計算を行い、問題なければresults配列に格納する
        // 上記を全ての数で行い、results配列を返す

        $results = [];

        for ($i = 2; $i < 1000; $i++) {

            for ($j = 1; $j < 1000; $j++) {

                $sum = 0;

                foreach (str_split(base_convert($i * $j, 10, $base)) as $value) {
                    $sum += base_convert($value, $base, 10);
                }

                if ($sum % $i !== 0) continue 2;

                if (strlen($i * $j) >= 3) {
                    if ($j !== 1) $results[] = $i;
                    continue 2;
                }
            }
        }

        return $results;
    }
}