<?php

namespace ProCon;

class PartialSumCalculator
{
    static public function judge($subjects, $sumTarget)
    {
        sort($subjects);
        $cleanedPartialNumSubjects = [];
        for ($i = 0; $i < count($subjects); $i++) {
            if ($subjects[$i] === $sumTarget) {
                return true;
            }
            if ($subjects[$i] > $sumTarget) {
                break;
            }
            $cleanedPartialNumSubjects[] = $subjects[$i];
        }

        $result = PartialSumCalculator::calcPartialSum(0, array_reverse($cleanedPartialNumSubjects), 0, $sumTarget);
        return $result === $sumTarget;
    }

    static private function calcPartialSum($sum, $subjects, $next, $sumTarget)
    {
        /*
         * コレまでの合計値と、次に加えるkeyを渡される
         * 合計値に新しい値をくわえて、目的の値よりも大きくなったら、$sumのみで自分自身を呼び出す
         * ただし、次の値がなければ、そのまま$sumを返す
         * $newSumが使える場合、$sumと$newSumで自分自身を呼び出し、大きい方を返す
         * この時も、次の値がなければ、$sumと$newSumの大きい方を返す
         */
        $newSum = $subjects[$next] + $sum;
        if ($newSum > $sumTarget) {
            if (count($subjects) <= $next + 1) {
                return $sum;
            }
            return PartialSumCalculator::calcPartialSum($sum, $subjects, ++$next, $sumTarget);
        }
        if (count($subjects) <= $next + 1) {
            return max($sum, $newSum);
        }
        return max(PartialSumCalculator::calcPartialSum($sum, $subjects, $next + 1, $sumTarget),
                   PartialSumCalculator::calcPartialSum($newSum, $subjects, $next + 1, $sumTarget));
    }
}