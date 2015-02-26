<?php

namespace ProCon;

class LongSamePartSet
{
    public function calc($firstWords, $secondWords)
    {
        /*
         * 全探索だと
         * まずresult = 0
         * firstWordsの0をピックアップ
         * secondWordsで同じ文字を探す
         * なければreturn result
         * 存在すればresult++
         * その次の文字から、firstWordsの次のインデックスの文字を探す
         * 上記の探索を繰り返し、firstWordsかsecondWordsのどちらかが最後まで到達したら、return result
         *
         * DP
         * firstWordsの終わりの文字から検索する
         * secondWordsから文字を発見したら、そのインデックスと、文字列の長さをメモる
         * 次の文字は、インデックスよりも右側にあるインデックスを持つデータがメモにあれば、
         * そこまでの文字列の長さに1をくわえ、インデックスと一緒にメモる
         * firstWordsの先頭まで到達した時の文字列の長さが一番大きいものが答え
         */

        $maxLengths = [];
        for ($i = mb_strlen($firstWords) - 1; $i >= 0; $i--) {
            $selfLengths = [];
            for ($j = mb_strlen($secondWords) - 1; $j >= 0; $j--) {
                if ($firstWords[$i] === $secondWords[$j]) {
                    $length = 0;
                    foreach ($maxLengths as $index => $maxLength) {
                        if ($j < $index && $length < $maxLength) {
                            $length = $maxLength;
                        }
                    }
                    $selfLengths[$j] = $length + 1;
                }
            }
            $maxLengths = $selfLengths + $maxLengths;
        }
        return count($maxLengths) === 0 ? 0 : max($maxLengths);
    }
}