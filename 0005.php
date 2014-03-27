<?php

class ThePalindrome {

    function find($s) {
        // $returnに、$sの文字数を入れる
        // $sを分解する
        // 片方を反転する
        // 先頭から比較し、不一致があれば、反転してないほうの先頭を捨てる
        // このとき、$returnに1を足す
        // もう一度反転した配列を作り、比較
        // 一致すれば、現在の$returnを返す

        $return = mb_strlen($s);

        $array_s = str_split($s);
        while(true) {
            $reverse_array_s = array_reverse($array_s);
            if ($array_s === $reverse_array_s) return $return;
            array_shift($array_s);
            $return++;
        }
    }
}