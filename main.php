<?php

require('play.php');
require('lib.php');

echonl("Welcome to the TogyzKumalak world!");
echonl("Enter the mode (h - human play, m - random machine, r - against random AI): ");
$gameMode = readline();

if ($gameMode == "h") {
    humanPlay();
} elseif ($gameMode == "m") {
    machinePlay();
} elseif ($gameMode == "r") {
    randomPlay();
}