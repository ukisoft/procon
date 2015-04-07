<?php

$inputs = explode(' ', trim(fgets(STDIN)));

$peopleNum = (int)$inputs[0];
$relationNum = (int)$inputs[1];

$relations = array();

for ($i = 0; $i < $relationNum; $i++) {
    array_push($relations, explode(' ', trim(fgets(STDIN))));
}

$groups = array();
foreach ($relations as $relation) {
    foreach ($groups as &$group) {
        if (in_array($relation[0], $group) && in_array($relation[1], $group) === false) {
            $count = 0;
            foreach ($group as $person) {
                if (in_array(array($person, $relation[1]) ,$relations) || in_array(array($relation[1], $person) ,$relations)) {
                    $count++;
                }
            }
            if ($count === count($group)) {
                array_push($group, $relation[1]);
            }
        }
        if (in_array($relation[1], $group) && in_array($relation[0], $group) === false) {
            $count = 0;
            foreach ($group as $person) {
                if (in_array(array($person, $relation[0]) ,$relations) || in_array(array($relation[0], $person) ,$relations)) {
                    $count++;
                }
            }
            if ($count === count($group)) {
                array_push($group, $relation[0]);
            }
        }
    }
    array_push($groups, array($relation[0], $relation[1]));
}

$result = 1;
foreach ($groups as $group) {
    if ($result < count($group)) {
        $result = count($group);
    }
}

echo $result . "\n";