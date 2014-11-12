<?php

namespace ProCon;

class TaskScheduler
{
    public static function findMaxTaskCount($startTimes, $endTimes)
    {
        $taskCount = 0;
        // タスクをこなすたびに、startTimesを減らしていくので、評価式はstartTimesの数。
        while (count($startTimes) > 0) {
            // 残っている最小のstartTimesに対応したKeyを取得する。
            $nextTaskKey = 100001;
            $nextStartTime = 100000001;
            array_map(function($key, $startTime) use (&$nextTaskKey, &$nextStartTime) {
                if ($startTime < $nextStartTime) {
                    $nextTaskKey = $key;
                    $nextStartTime = $startTime;
                }
            }, array_keys($startTimes), $startTimes);
            // 対応する終了時間を退避。
            $lastEndTime = $endTimes[$nextTaskKey];
            $taskCount++;
            // 終了時間よりも前に始まるタスクを削除する。
            $startTimes = array_filter($startTimes, function($startTime) use ($lastEndTime) {
                if ($startTime > $lastEndTime) {
                    return $startTime;
                }
            });
        }
        return $taskCount;
    }

} 