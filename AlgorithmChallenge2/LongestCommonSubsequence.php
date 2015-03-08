<?php

namespace ProCon;

class LongestCommonSubsequence
{
    public static function calc($firstWords, $secondWords)
    {
        /**
         * 事前にmb_strlen($firstWords) x mb_strlen($secondWords)の２次元配列noteを作っておく
         * 0列目、0行目にそれぞれ０を挿入
         * secondWordsに対し、firstWordsを１文字ずつ比較していく
         * 比較した結果、一致しなければ、１行目前、１列目前の値をそれぞれ確認し、大きい方の値をnoteにメモする
         * 一致していれば、１行目、且つ１列目前の値に１を加えた値をnoteにメモする
         * ※メモリがあふれるので、使った値はメモリ解放
         * 全て比較し終わった結果、note[mb_strlen($firstWords)][mb_strlen($secondWords)]に入っている値が答え
         */

        $note = [];
        for ($i = 0; $i <= mb_strlen($firstWords); $i++) {
            $note[$i] = [];
            if ($i === 0) {
                for ($j = 1; $j <= mb_strlen($secondWords); $j++) {
                    $note[$i][$j] = 0;
                }
                continue;
            }
            $note[$i][0] = 0;
        }

        for ($i = 0; $i < mb_strlen($firstWords); $i++) {
            for ($j = 0; $j < mb_strlen($secondWords); $j++) {
                if ($firstWords[$i] === $secondWords[$j]) {
                    $note[$i + 1][$j + 1] = $note[$i][$j] + 1;
                } else {
                    $note[$i + 1][$j + 1] = max($note[$i][$j + 1], $note[$i + 1][$j]);
                }
            }
            unset($note[$i]);
        }
        return $note[mb_strlen($firstWords)][mb_strlen($secondWords)];
    }
}