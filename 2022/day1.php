<?php

$contents = file_get_contents(dirname(__FILE__) . '/data/day1.txt');
$data = explode("\n", $contents);

$elves = [];
$i = 0;

foreach ($data as $value) {
    if (empty($value)) {
        $i++;
        continue;
    }

    if (!array_key_exists($i, $elves)) {
        $elves[$i] = 0;
    }

    $elves[$i] += $value;
}

echo 'First answer: ' . max($elves) . PHP_EOL;

rsort($elves);

echo 'Second answer: ' . array_sum(array_slice($elves, 0, 3)) . PHP_EOL;