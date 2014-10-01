<?php

namespace ProCon;

class ColorfulBoxesAndBalls
{
    public function getMaximum($numRed, $numBlue, $onlyRed, $onlyBlue, $bothColors)
    {
        /*
         * 初期状態の結果を計算する
         * 青と赤を1箇所入れ替える
         * 初期状態と大小比較する
         * 大きくなれば、可能な限り入れ替えてreturn
         * 同じか小さくなれば、入替えをキャンセルしてreturn
         */

        if ($onlyRed + $onlyBlue > $bothColors * 2) {
            return $numRed * $onlyRed + $numBlue * $onlyBlue;
        } else {
            $maxChangeableNum = min($numRed, $numBlue);
            return ($numRed - $maxChangeableNum) * $onlyRed
                    + ($numBlue - $maxChangeableNum) * $onlyBlue
                    + 2 * $maxChangeableNum * $bothColors;
        }
    }
}