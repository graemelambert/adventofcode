<?php

function getStacks(array $columns): array
{
    $stacks = [];
    foreach (range(1, 9) as $stack) {
        $stacks[$stack] = [];
    }

    foreach ($columns as $string) {
        $indexes = [1];
        for ($i = 1; $i < 9; $i++) {
            $indexes[] = $indexes[$i - 1] + 4;
        }
        foreach ($indexes as $i => $index) {
            if (!empty(trim($string[$index] ?? ''))) {
                $stacks[$i + 1][] = $string[$index];
            }
        }
    }

    return $stacks;
}

$contents = file_get_contents(dirname(__FILE__) . '/data/day5.txt');
$data = explode("\n", $contents);

$columns = [];
$procedures = [];

foreach ($data as $line) {
    if (str_starts_with($line, 'move')) {
        $procedures[] = $line;
        continue;
    }

    if (!str_contains($line, '[')) {
        continue;
    }

    $columns[] = $line;
}

$stacks = getStacks($columns);

foreach ($procedures as $procedure) {
    preg_match_all('/\d+/', $procedure, $numbers);
    [$move, $from, $to] = $numbers[0];

    for ($i = 0; $i < $move; $i++) {
        $crate = array_shift($stacks[$from]);
        array_unshift($stacks[$to], $crate);
    }
}

$firstAnswer = '';
foreach ($stacks as $stack) {
    $firstAnswer .= $stack[0];
}

echo 'First answer: ' . $firstAnswer . PHP_EOL;

$stacks = getStacks($columns);

foreach ($procedures as $procedure) {
    preg_match_all('/\d+/', $procedure, $numbers);
    [$move, $from, $to] = $numbers[0];

    $toMove = [];
    for ($i = 0; $i < $move; $i++) {
        $crate = array_shift($stacks[$from]);
        array_unshift($toMove, $crate);
    }
    $stacks[$to] = array_merge(array_reverse($toMove), $stacks[$to]);
}

$secondAnswer = '';
foreach ($stacks as $stack) {
    $secondAnswer .= $stack[0];
}

echo 'Second answer: ' . $secondAnswer . PHP_EOL;
