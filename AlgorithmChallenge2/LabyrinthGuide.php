<?php

namespace ProCon;

class LabyrinthGuide
{
    public static function findShortestStep($mapData)
    {
        $labyrinthMap = new LabyrinthMap($mapData);
        $stepStockQueue = new \SplQueue();
        $stepStockQueue->enqueue($labyrinthMap->getStartPosition());
        while (count($stepStockQueue) > 0) {
            $step = $stepStockQueue->dequeue();
            if ($labyrinthMap->isGoal($step)) {
                return $step->getCount();
            }
            if ($labyrinthMap->isWall($step) || $labyrinthMap->isAvailable($step) === false) {
                continue;
            }
            foreach ($step->createNextSteps() as $nextStep) {
                $stepStockQueue->enqueue($nextStep);
            }
        }
        throw new \DomainException('ゴールにたどり着けません。');
    }
}

class LabyrinthMap
{
    public function __construct($mapData)
    {
        $this->map = [];
        foreach ($mapData as $key => $mapLine) {
            $parsedMapLine = str_split($mapLine);
            $this->map[] = $parsedMapLine;
            if ($this->start == [] && array_search('S', $parsedMapLine) != false) {
                $this->start = new Step(array_search('S', $parsedMapLine), $key);
            }
        }
        $this->maxRow = count($this->map);
        $this->maxColumn = count($this->map[0]);
    }

    public function getStartPosition()
    {
        return $this->start;
    }

    /**
     * @param Step $step
     * @return bool
     */
    public function isGoal($step)
    {
        return $this->map[$step->getY()][$step->getX()] === 'G';
    }

    /**
     * @param Step $step
     * @return bool
     */
    public function isWall($step)
    {
        return $this->map[$step->getY()][$step->getX()] === '#';
    }

    /**
     * @param Step $step
     * @return bool
     */
    public function isAvailable($step)
    {
        if ($step->getX() < 0 || $step->getX() >= $this->maxColumn) {
            return false;
        }
        if ($step->getY() < 0 || $step->getY() >= $this->maxRow) {
            return false;
        }
        return true;
    }
}

class Step
{
    public function __construct($x, $y, $from = StepFrom::neutral, $count = 0)
    {
        $this->x = $x;
        $this->y = $y;
        $this->from = $from;
        $this->count = $count;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param Step $step
     * @return bool
     */
    public function equals($step)
    {
        return $this->getX() === $step->getX() && $this->getY() === $step->getY();
    }

    public function createNextSteps()
    {
        $nextSteps = [new Step($this->x - 1, $this->y, StepFrom::right, $this->count + 1),
                      new Step($this->x + 1, $this->y, StepFrom::left, $this->count + 1),
                      new Step($this->x, $this->y - 1, StepFrom::down, $this->count + 1),
                      new Step($this->x, $this->y + 1, StepFrom::up, $this->count + 1)];
        if ($this->from === StepFrom::up) {
            unset($nextSteps[2]);
        }
        if ($this->from === StepFrom::down) {
            unset($nextSteps[3]);
        }
        if ($this->from === StepFrom::right) {
            unset($nextSteps[1]);
        }
        if ($this->from === StepFrom::left) {
            unset($nextSteps[0]);
        }
        return $nextSteps;
    }
}

class StepFrom// extends \SplEnum
{
    const __default = self::neutral;
    const up = 'up';
    const down = 'down';
    const right = 'right';
    const left = 'left';
    const neutral = 'neutral';
}