<?php

namespace Procon;

class BatchSystem
{
    public function schedule($duration, $user)
    {
        $taskSet = array_map(function ($oneDurationKey, $oneDuration, $oneUser) {return ["num" => $oneDurationKey, "duration" => $oneDuration, "user" => $oneUser];}, array_keys($duration), array_values($duration), $user);
        array_multisort($duration, $user, $taskSet);
        return array_map(function ($task) {return $task["num"];}, $taskSet);
    }
}