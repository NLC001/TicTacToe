<?php

include 'TicTacToe.html';

function print_board($board) {
    echo "|-------------|\n";
    echo "| Tic Tac Toe |\n";
    echo "|-------------|\n";
    echo "|             |\n";
    echo "|    " . $board[0][0] . " " . $board[0][1] . " " . $board[0][2] . "    |\n";
    echo "|    " . $board[1][0] . " " . $board[1][1] . " " . $board[1][2] . "    |\n";
    echo "|    " . $board[2][0] . " " . $board[2][1] . " " . $board[2][2] . "    |\n";
    echo "|             |\n";
    echo "|-------------|\n\n";
}

function select_space(&$board, $move, $turn) {
    if ($move < 1 || $move > 9) {
        return false;
    }
    $row = intval(($move - 1) / 3);
    $col = ($move - 1) % 3;
    if ($board[$row][$col] != "X" && $board[$row][$col] != "O") {
        $board[$row][$col] = $turn;
        return true;
    } else {
        return false;
    }
}

function available_moves($board) {
    $moves = array();
    foreach ($board as $row) {
        foreach ($row as $col) {
            if ($col != "X" && $col != "O") {
                $moves[] = intval($col);
            }
        }
    }
    return $moves;
}

function has_won($board, $player) {
    foreach ($board as $row) {
        if (array_count_values($row)[$player] === 3) {
            return true;
        }
    }

    for ($i = 0; $i < 3; $i++) {
        if ($board[0][$i] == $player && $board[1][$i] == $player && $board[2][$i] == $player) {
            return true;
        }
    }

    if ($board[0][0] == $player && $board[1][1] == $player && $board[2][2] == $player) {
        return true;
    }

    if ($board[0][2] == $player && $board[1][1] == $player && $board[2][0] == $player) {
        return true;
    }

    return false;
}

$start_board = [
    ["1", "2", "3"],
    ["4", "5", "6"],
    ["7", "8", "9"]
];

//print_board($start_board);
// Example move:
$select_move = 5;
$select_turn = "X";
select_space($start_board, $select_move, $select_turn);
//print_board($start_board);
?>