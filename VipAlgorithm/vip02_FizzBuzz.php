<?php

/*
 * なんか偉い人が考えた問題
 * ルールは以下の通り
 * 1から順番に数を表示する
 * その数が3で割り切れるなら"Fizz"、5で割り切れるなら"Buzz"、両方で割り切れるなら"FizzBuzz"と表示する
 * 要するに"1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz ･･･"と出力される
 * プログラマかどうかがわかるんだとさ
 * 実行例
 * 1 2 Fizz 4 Buzz Fizz 7 8 Fizz Buzz 11 Fizz 13 14 FizzBuzz 16 17 Fizz 19 Buzz Fizz 22 23 Fizz Buzz 26 Fizz 28 29 FizzBuzz 31 32 Fizz 34
 */

namespace Vip;

class FizzBuzz {
    static public function getFizzBuzz($num)
    {
        $result = '';
        for ($i = 1; $i <= $num; $i++) {
            $output = '';
            if ($i % 3 === 0) {
                $output .= 'Fizz';
            }
            if ($i % 5 === 0) {
                $output .= 'Buzz';
            }
            if (strlen($output) === 0) {
                $output = (string)$i;
            }
            $result .= $output . "\n";
        }
        return $result;
    }
}
