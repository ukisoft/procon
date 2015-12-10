<?php

namespace ProCon;

class LabyrinthGuide2
{
    public static function findShortestStep($mapData)
    {
        $map = [];
        $start = [];
        foreach ($mapData as $row => $line) {
            if (strpos($line, 'S') !== false) {
                $start = [strpos($line, 'S'), $row, 0];
            }
            $map[] = str_split($line);
        }
        $stepQueue = new \SplQueue();
        $stepQueue->enqueue($start);
        $wayX = [0, 0, 1, -1];
        $wayY = [1, -1, 0, 0];
        $maxY = count($map);
        $maxX = count($map[0]);
        while (count($stepQueue) > 0) {
            $step = $stepQueue->dequeue();
            if ($step[0] < 0 || $step[0] >= $maxX || $step[1] < 0 || $step[1] >= $maxY
                || $map[$step[1]][$step[0]] === '#' || $map[$step[1]][$step[0]] === '*') {
                continue;
            }
            if ($map[$step[1]][$step[0]] === 'G') {
                return $step[2];
            }
            array_map(function($x, $y) use ($stepQueue, $step, &$map) {
                $stepQueue->enqueue([$step[0] + $x, $step[1] + $y, $step[2] + 1]);
                $map[$step[1]][$step[0]] = '*';
            }, $wayX, $wayY);
        }
        throw new \DomainException('ゴールにたどり着けませんでした。');
    }
}