<?php

class Cryptography {

    public function encypt(array $numbers) {
        $base = 1;
        foreach ($numbers as $number) $base *= $number;
        foreach ($numbers as $number) $results[] = $base / $number * ($number + 1);
        return max($results);
    }
}