<?php

namespace ProCon;

class TaskScheduler
{
    public static function findMaxTaskCount($startTimes, $endTimes)
    {
        array_multisort($startTimes, SORT_ASC, $endTimes);
        sort($endTimes);

        $taskCount = 0;
        $lastEndTime = 0;
        foreach ($endTimes as $key => $endTime) {
            if ($lastEndTime < $startTimes[$key]) {
                $lastEndTime = $endTime;
                $taskCount++;
            }
        }
        return $taskCount;
    }
} 