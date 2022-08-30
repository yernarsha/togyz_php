<?php

require('tog.php');

function humanPlay() {
    $tBoard = new TogyzBoard();

    while (true) {
        echonl("Enter your move (1-9, 0 - exit): ");
        $input = readline();
        if ($input == 0) {
            break;
        }

        if (($input >= 1) && ($input <= 9)) {
            $tBoard->makeMove($input);
            $tBoard->printNotation();
            $tBoard->printPosition();
            if ($tBoard->isGameFinished()) {
                break;
            }
        }
    }

    $tBoard->printNotation();
    $tBoard->printPosition();
    echonl("Game over: " . $tBoard->getScore() . ". Result: " . $tBoard->getResult());
}

function machinePlay() {
    while (true) {
        echonl("Enter number of iterations (1-100000): ");
        $num = readline();
        if (($num >= 1) && ($num <= 100000)) {
            break;
        }
    }

    $win = $draw = $loss = 0;
    $starttime = microtime(true);

    for ($i = 0; $i < $num; $i++) {
        $tBoard = new TogyzBoard();
        while (!$tBoard->isGameFinished()) {
            $tBoard->makeRandomMove();
        }

        if ($num <= 5) {
            $tBoard->printPosition();
            echonl("Game over: " . $tBoard->getScore() . ". Result: " . $tBoard->getResult());
        }

        if ($tBoard->getResult() == 1) {
            $win += 1;
        } elseif ($tBoard->getResult() == -1) {
            $loss += 1;
        } elseif ($tBoard->getResult() == 0) {
            $draw += 1;
        } else {
            echonl("What??");
        }
    }

    $endtime = microtime(true);
    echonl("Elapsed: " . ($endtime - $starttime) . " sec");
    echonl("W: $win, D: $draw, L: $loss");
}

function randomPlay() {
    $tBoard = new TogyzBoard();
    $currentColor = 0;

    while (true) {
        echonl("Enter your color (0 - white, 1 - black): ");
        $color = readline();
        if (($color == 0) || ($color == 1)) {
            break;
        }
    }

    while (!$tBoard->isGameFinished()) {
        if ($currentColor == $color) {
            while (true) {
                echonl("Enter your move (1-9, 0 - exit): ");
                $move = readline();
                if (($move >= 0) && ($move <= 9)) {
                    break;
                }
            }

            if ($move == 0) {
                break;
            }

            $tBoard->makeMove($move);
            $tBoard->printNotation();
            $tBoard->printPosition();
            $currentColor = $currentColor == 0 ? 1 : 0;
        } else {
            $ai = $tBoard->makeRandomMove();
            echonl("AI move: $ai");
            $tBoard->printPosition();
            $currentColor = $currentColor == 0 ? 1 : 0;
        }
    }

    $tBoard->printNotation();
    $tBoard->printPosition();
    echonl("Game over: " . $tBoard->getScore() . ". Result: " . $tBoard->getResult());
}