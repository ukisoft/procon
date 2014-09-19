<?php

namespace ProCon;

class NumberMagicEasy {

    public function theNumber($answer) {

        // answerを分割
        // 1-16の配列を作成
        // Yならカードの中身を、Nなら1-16の配列との差分を取得
        // 上記の全てに合致する値を返す（カウントアップで４の値）

        $cards = [[1, 2, 3, 4, 5, 6, 7, 8], [1, 2, 3, 4, 9, 10, 11, 12], [1, 2, 5, 6, 9, 10, 13, 14], [1, 3, 5, 7, 9, 11, 13, 15]];
        $base = range(1, 16);

        foreach (str_split($answer) as $answerNo => $oneAnswer) {
            if ($oneAnswer === 'Y') $base = array_diff($base, array_diff($base, $cards[$answerNo]));
            else $base = array_diff($base, $cards[$answerNo]);
        }

        return array_shift($base);
    }
}