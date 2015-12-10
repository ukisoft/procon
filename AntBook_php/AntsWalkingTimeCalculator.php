<?php

namespace ProCon;

class AntsWalkingTimeCalculator
{
    public static function getMaxWalkingTime($barLength, $antsNum, $antsPosition)
    {
        /*
         * 最も中心から遠いアリが、最も遠い端まで歩く時間が再長時間
         */

        $maxDistanceFromCenter = 0;
        $halfOfBarLength = $barLength / 2;
        foreach ($antsPosition as $antPosition) {
            $maxDistanceFromCenter = max($maxDistanceFromCenter, abs($halfOfBarLength - $antPosition));
        }

        return $maxDistanceFromCenter + $halfOfBarLength;
    }

    public static  function getMinWalkingTime($barLength, $antsNum, $antsPosition)
    {
        /*
         * 最も中心に近いアリが、最も近い端まで歩く時間が最短時間
         */

        $minDistanceFromCenter = 1000000;
        $halfOfBarLength = $barLength / 2;
        foreach ($antsPosition as $antPosition) {
            $minDistanceFromCenter = min($minDistanceFromCenter, abs($halfOfBarLength - $antPosition));
        }

        return $halfOfBarLength - $minDistanceFromCenter;
    }
} 