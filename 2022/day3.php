<?php

function getPriorityOfCommonValues(...$arrays): int
{
    $common = current(array_unique(array_intersect(...$arrays)));
    $priority = ord(strtoupper($common)) - ord('A') + 1;
    if (strtoupper($common) === $common) {
        $priority += 26;
    }
    return $priority;
}

$contents = file_get_contents(dirname(__FILE__) . '/data/day3.txt');
$data = explode("\n", $contents);

$total = 0;
foreach ($data as $rucksack) {
    $items = str_split($rucksack);
    $total += getPriorityOfCommonValues(...array_chunk($items, count($items) / 2));
}

echo 'First answer: ' . $total . PHP_EOL;

$groups = [];
$x = 0;
foreach ($data as $i => $elf) {
    if ($i % 3 === 0) {
        $x++;
    }

    $groups[$x][] = str_split($elf);
}

$total = 0;
foreach ($groups as $elves) {
    $total += getPriorityOfCommonValues(...$elves);
}

echo 'Second answer: ' . $total . PHP_EOL;

