<?php

namespace ProCon;

class HandShaking
{
    private $numberOfPeople;

    public function countPerfect($n)
    {
        /*
         * 要素1が次に手の開いている人を探し握手する
         * このとき、握手した人との間が奇数であればreturn
         * 次に開いている人を探し、その人がさらに別の人を探し握手する
         * 全員握手の状態になったら、return 1
         * このとき、握手した人との間が奇数、もしくは間に握手している人がいて、且つクロスしている人であればreturn
         * これを、n/2まで続け、合計を2倍した数をreturn
         *
         * 上記は、n=2のときだけ上手くいかないので、分岐
         */

        if ($n === 2) {
            return 1;
        }

        $this->numberOfPeople = $n;
        $allShakingStatus = array_fill(0, $n, null);

        $result = 0;
        for ($i = 1; $i < $n / 2; $i++) {
            $result += $this->shake(0, $i, $allShakingStatus);
        }
        return $result * 2;
    }

    private function shake($shakingSender, $shakingReceiver, $allShakingStatus)
    {
        if (($shakingReceiver - $shakingSender) % 2 === 0) {
            return 0;
        }

        for ($i = $shakingSender + 1; $i < $shakingReceiver; $i++) {
            if (is_null($allShakingStatus[$i]) === false) {
                if ($allShakingStatus[$i] < $shakingSender || $allShakingStatus[$i] > $shakingReceiver) {
                    return 0;
                }
            }
        }

        $allShakingStatus[$shakingSender] = $shakingReceiver;
        $allShakingStatus[$shakingReceiver] = $shakingSender;

        $notShakingCount= 0;
        foreach ($allShakingStatus as $shakingStatus) {
            if (is_null($shakingStatus)) {
                $notShakingCount++;
            }
        }
        if ($notShakingCount === 0) {
            return 1;
        }

        $result = 0;
        foreach ($allShakingStatus as $nextShakingSender => $nextShakingReceiver) {
            if ($nextShakingSender <= $shakingSender) {
                continue;
            }
            if (is_null($nextShakingReceiver)) {
                for ($i = $nextShakingSender + 1; $i < $this->numberOfPeople; $i++) {
                    if (is_null($allShakingStatus[$i]) === false) {
                        continue;
                    }
                    $result += $this->shake($nextShakingSender, $i, $allShakingStatus);
                }
            }
        }
        return $result;
    }
}
