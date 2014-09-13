<?php

namespace Vip;

class PrimeNumberChecker {
    /*
     * 与えられた数が素数かどうか調べる
     * あるいは与えられた数までの素数を列挙する
     * 処理にかかった時間を計測しておくと、自分の技術向上に伴って処理時間が短くなっていくのがよくわかる
     */

    static public function check($target)
    {
        if ($target <= 0) {
            return false;
        }
        if ($target === 1) {
            return true;
        }
        for ($i = 2; $i < $target; $i++) {
            if ($target % $i === 0) {
                return false;
            }
        }
        return true;
    }
}