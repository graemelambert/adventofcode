<?php

function findIndexAfterDistinctCharacters(int $numberOfCharacters, array $characters): int
{
    $lastX = [];
    foreach ($characters as $index => $letter) {
        if (count($lastX) < $numberOfCharacters) {
            $lastX[] = $letter;
            continue;
        }

        array_shift($lastX);
        $lastX[] = $letter;

        if (count(array_unique($lastX)) === $numberOfCharacters) {
            return $index + 1;
        }
    }

    throw new Exception('Failed to find answer.');
}

$contents = file_get_contents(dirname(__FILE__) . '/data/day6.txt');
$data = str_split($contents);

echo 'First answer: ' . findIndexAfterDistinctCharacters(4, $data) . PHP_EOL;
echo 'Second answer: ' . findIndexAfterDistinctCharacters(14, $data) . PHP_EOL;
