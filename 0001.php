<?php

class KiwiJuiceEasy {

    function thePouring($capacities, $bottles, $fromId, $toId) {
        array_map(function($from, $to) use ($capacities, &$bottles) {
            $movingAmount = min($bottles[$from], $capacities[$to] - $bottles[$to]);
            $bottles[$from] -= $movingAmount;
            $bottles[$to] += $movingAmount;
        }, $fromId, $toId);

        return $bottles;
    }
}