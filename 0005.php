<?php

namespace ProCon;

class ThePalindrome {

    function find($s) {
        // $resultに、$sの文字数を入れる
        // $sを分解する
        // 片方を反転する
        // 先頭から比較し、不一致があれば、反転してないほうの先頭を捨てる
        // このとき、$resultに1を足す
        // もう一度反転した配列を作り、比較
        // 一致すれば、現在の$resultを返す

        $result = mb_strlen($s);

        $array_s = str_split($s);
        while(true) {
            $reverse_array_s = array_reverse($array_s);
            if ($array_s === $reverse_array_s) return $result;
            array_shift($array_s);
            $result++;
        }
    }
}