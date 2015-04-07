<?php

$vowel = array('a', 'i', 'u', 'e', 'o');
$words = array_filter(str_split(trim(fgets(STDIN))), function ($word) use ($vowel) {
    return (in_array($word, $vowel) === false);
});

echo implode('', $words) . "\n";