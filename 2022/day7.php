<?php

$contents = file_get_contents(dirname(__FILE__) . '/data/day7.txt');
$data = explode("\n", $contents);

$fs = [];
$currentDir = [];
foreach ($data as $cmd) {
    $parts = explode(' ', $cmd);

    if ($parts[0] === 'dir') {
        continue;
    }

    if ($parts[0] === '$') {
        $command = $parts[1];

        if ($command === 'ls') {
            continue;
        }

        # if command is not "ls", it's "cd"
        if ($parts[2] === '..') {
            array_pop($currentDir);
        } else {
            $currentDir[] = $parts[2];
        }

        continue;
    }

    $path = implode('#', $currentDir) . '#' . $parts[1];
    $fs[$path] = $parts[0];
}

$dirs = [];

foreach ($fs as $path => $size) {
    $parts = explode('#', $path);
    $file = array_pop($parts);
    for ($i = count($parts) - 1; $i >= 0; $i--) {
        $tmpParts = [];
        for ($x = 0; $x <= $i; $x++) {
            $tmpParts[] = $parts[$x];
        }
        $tmpPath = implode('#', $tmpParts);
        if (!array_key_exists($tmpPath, $dirs)) {
            $dirs[$tmpPath] = [];
        }
        $dirs[$tmpPath][$path] = $size;
    }
}

$sizes = [];
$firstAnswer = [];
foreach ($dirs as $path => $files) {
    $size = array_sum(array_values($files));
    $sizes[$path] = $size;
    if ($size <= 100000) {
        $firstAnswer[] = $size;
    }
}

echo 'First answer = ' . array_sum($firstAnswer) . PHP_EOL;



uasort($sizes, function ($a, $b) {
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
});

$totalDiskSize = 70000000;
$totalUsage = max(array_values($sizes));
$available = $totalDiskSize - $totalUsage;
$required = 30000000;
$toFreeUp = $required - $available;

foreach ($sizes as $path => $size) {
    if ($size < $toFreeUp) {
        continue;
    }
    echo 'Second answer = ' . $size . PHP_EOL;
    break;
}
