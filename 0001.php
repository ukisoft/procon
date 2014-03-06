<?php

	$result = array();
	$dododoCount = 100;
	for ($i = 0; $i < $dododoCount; $i++) {
		$result[] = dododo();
	}

	var_dump(array_sum($result)/$dododoCount);
	
	function dododo() {
		$now = microtime(true);

		$N = 50;
		$capacities = $bottles = range(1, $N);

		foreach ($capacities as $key => &$capacity) {
			$capacity = rand(1, 1000000);
			$bottles[$key] = rand(0, $capacity);
		}

		var_dump($capacities);
		var_dump($bottles);


		$M = 1000000;

		for ($i = 0; $i < $M; $i++) {
			$from = rand(0, $N-1);
			$to;
			do {
			 	$to = rand(0, $N-1);
			} while ($from === $to);

			if ($capacities[$to] - $bottles[$to] > $bottles[$from]) {
				$bottles[$to] += $bottles[$from];
				$bottles[$from] = 0;
			} else {
				$bottles[$from] -= $capacities[$to] - $bottles[$to];
				$bottles[$to] = $capacities[$to];
			}
		}
    	var_dump($bottles);

		return microtime(true) - $now;
	}