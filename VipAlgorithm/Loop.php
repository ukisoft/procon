<?php

/*
 * Hello World![改行]を5回表示させてください。 print(或いはprintf,cout等)を5回コピーすれば当然可能ですが、
 * ループ構文(for,while等)を利用して、print等は1回の使用にとどめてみてください。
 */

namespace Vip;

class Loop {
    static public function getLoop($num)
    {
        $result = '';
        for ($i = 0; $i < $num; $i++) {
            $result .= "Hello World!\n";
        }
        return $result;
    }
}
