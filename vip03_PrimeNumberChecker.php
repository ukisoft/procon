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
        if ($target <= 1) {
            return false;
        }
        if ($target === 2) {
            return true;
        }
        if ($target % 2 === 0) {
            return false;
        }
        for ($i = 3; $i < $target / 2; $i += 2) {
            if ($target % $i === 0) {
                return false;
            }
        }
        return true;
    }
}