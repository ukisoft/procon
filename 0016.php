<?php

namespace ProCon;

class BatchSystem
{
    public function schedule($duration, $user)
    {
        $users = [];
        array_map(function ($oneDuration, $oneUser, $userKey) use (&$users) {
            foreach ($users as $user) {
                if ($user->getName() == $oneUser) {
                    $user->addNewTask($oneDuration, $userKey);
                    return;
                }
            }
            $users[] = new User($oneDuration, $oneUser, $userKey);
        }, $duration, array_values($user), array_keys($user));

        $sortAverageDuration = [];
        $sortName = [];
        $sortPosition = [];
        foreach ($users as $oneUser) {
            $sortAverageDuration[] = $oneUser->getAverageDuration();
            $sortName[] = $oneUser->getName();
            $sortPosition[] = $oneUser->getPosition();
        }

        array_multisort($sortAverageDuration, $sortName, $sortPosition);
        $result = [];
        foreach ($sortPosition as $oneUserPosition) {
            foreach ($oneUserPosition as $onePosition) {
                $result[] = $onePosition;
            }
        }

        return $result;
    }
}

class User
{
    private $name;
    private $totalDuration = 0;
    private $position = [];

    public function __construct($duration, $name, $position)
    {
        $this->name = $name;
        $this->totalDuration += $duration;
        $this->position[] = $position;
    }

    public function addNewTask($duration, $position)
    {
        $this->totalDuration += $duration;
        $this->position[] = $position;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAverageDuration()
    {
        return $this->totalDuration / count($this->position);
    }

    public function getPosition()
    {
        asort($this->position);
        return $this->position;
    }
}