<?php

namespace ProCon;

class ChessMetric
{
    private $stepPatterns = [[0, 1], [1, 1], [1, 0], [1, -1], [0, -1], [-1, -1], [-1, 0], [-1, 1],
                             [1, 2], [2, 1], [2, -1], [1, -2], [-1, -2], [-2, -1], [-2, 1], [-1, 2]];
    private $stepCounts;
    private $size;
    private $end;

    public function howMany($size, $start, $end, $numMoves)
    {
        $this->size = $size;
        $this->end = $end;
        $this->stepCounts = array_fill(0, $numMoves + 1, array_fill(0, $size, array_fill(0, $size, null)));

        $this->stepCounts[$numMoves][$start[0]][$start[1]] = 0;
        foreach ($this->stepPatterns as $stepPattern) {
            $this->stepCounts[$numMoves][$start[0]][$start[1]] += $this->calc($numMoves - 1, $start, $stepPattern);
        }

        return $this->stepCounts[$numMoves][$start[0]][$start[1]];
    }

    private function calc($restMove, $pastPosition, $stepPattern)
    {
        $nextPosition = [$pastPosition[0] + $stepPattern[0], $pastPosition[1] + $stepPattern[1]];
        if ($nextPosition[0] < 0 || $nextPosition[0] >= $this->size ||
            $nextPosition[1] < 0 || $nextPosition[1] >= $this->size) {
            return 0;
        }

        if ($restMove === 0) {
            if ($nextPosition[0] === $this->end[0] && $nextPosition[1] === $this->end[1]) {
                return 1;
            }
            return 0;
        }

        if (is_null($this->stepCounts[$restMove][$nextPosition[0]][$nextPosition[1]]) === false) {
            return $this->stepCounts[$restMove][$nextPosition[0]][$nextPosition[1]];
        }

        $this->stepCounts[$restMove][$nextPosition[0]][$nextPosition[1]] = 0;
        foreach ($this->stepPatterns as $stepPattern) {
            $this->stepCounts[$restMove][$nextPosition[0]][$nextPosition[1]]
                += $this->calc($restMove - 1, $nextPosition, $stepPattern);
        }
        return $this->stepCounts[$restMove][$nextPosition[0]][$nextPosition[1]];
    }
}
