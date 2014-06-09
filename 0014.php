<?php

namespace Procon;

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

        $result = $numRed * $onlyRed + $numBlue * $onlyBlue;
        $testResult = ($numRed - 1) * $onlyRed + ($numBlue - 1) * $onlyBlue + 2 * $bothColors;

        if ($result > $testResult) {
            return $result;
        } else {
            $maxChangeableNum = min($numRed, $numBlue);
            return ($numRed - $maxChangeableNum) * $onlyRed
                    + ($numBlue - $maxChangeableNum) * $onlyBlue
                    + 2 * $maxChangeableNum * $bothColors;
        }
    }
}