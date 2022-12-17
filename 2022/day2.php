<?php

$contents = file_get_contents(dirname(__FILE__) . '/data/day2.txt');
$data = explode("\n", $contents);

$score = 0;

foreach ($data as $round) {
    [$a, , $b] = str_split($round);
    // A = Rock, B = Paper, C = Scissors
    // X = Rock, Y = Paper, Z = Scissors

    if ($b === 'X') {
        $score += 1;
        $score += match ($a) {
            'A' => 3,
            'B' => 0,
            'C' => 6,
        };
    }

    if ($b === 'Y') {
        $score += 2;
        $score += match ($a) {
            'A' => 6,
            'B' => 3,
            'C' => 0,
        };
    }

    if ($b === 'Z') {
        $score += 3;
        $score += match ($a) {
            'A' => 0,
            'B' => 6,
            'C' => 3,
        };
    }
}

echo 'First answer: ' . $score . PHP_EOL;

$score = 0;
foreach ($data as $round) {
    [$a, , $b] = str_split($round);
    // A = Rock, B = Paper, C = Scissors
    // X = lose, Y = draw, Z = win

    $score += match ($b) {
        'X' => 0, // lose
        'Y' => 3, // draw
        'Z' => 6, // win
    };

    if ($a === 'A') {
        $score += match ($b) {
            'X' => 3, // play scissors to lose vs rock = 3pts
            'Y' => 1, // play rock to draw vs rock = 1pt
            'Z' => 2, // play paper to win vs rock = 2pts
        };
    }

    if ($a === 'B') {
        $score += match ($b) {
            'X' => 1, // play rock to lose vs paper = 1pt
            'Y' => 2, // play paper to draw vs paper = 2pts
            'Z' => 3, // play scissors to win vs paper = 3pts
        };
    }

    if ($a === 'C') {
        $score += match ($b) {
            'X' => 2, // play paper to lose vs scissors = 2pts
            'Y' => 3, // play scissors to draw vs scissors = 3pts
            'Z' => 1, // play rock to win vs scissors = 1pt
        };
    }
}

echo 'Second answer: ' . $score . PHP_EOL;
