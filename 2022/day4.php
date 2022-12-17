<?php

function getRange(string $rangeString): array
{
    [$start, $end] = explode('-', $rangeString);
    return range($start, $end);
}

$contents = file_get_contents(dirname(__FILE__) . '/data/day4.txt');
$data = explode("\n", $contents);

$total = 0;
foreach ($data as $pair) {
    [$firstElf, $secondElf] = explode(',', $pair);
    $firstElfRange = getRange($firstElf);
    $secondElfRange = getRange($secondElf);

    if (
        count(array_intersect($firstElfRange, $secondElfRange)) === count($firstElfRange)
        ||
        count(array_intersect($secondElfRange, $firstElfRange)) === count($secondElfRange)
    ) {
        $total++;
    }
}

echo 'First answer: ' . $total . PHP_EOL;

$total = 0;
foreach ($data as $pair) {
    [$firstElf, $secondElf] = explode(',', $pair);
    $firstElfRange = getRange($firstElf);
    $secondElfRange = getRange($secondElf);

    if (
        count(array_intersect($firstElfRange, $secondElfRange)) > 0
        ||
        count(array_intersect($secondElfRange, $firstElfRange)) > 0
    ) {
        $total++;
    }
}

echo 'Second answer: ' . $total . PHP_EOL;
