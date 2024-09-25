<?php

// Function to log moves with timestamps
function logMove($player, $move) {
    $timestamp = date('Y-m-d H:i:s'); // Get current timestamp
    $logMessage = "Timestamp: $timestamp, Player: $player, Move: $move";
    file_put_contents('logs.txt', $logMessage . PHP_EOL, FILE_APPEND);
}

function validate_board($board) {
    // Ensure the board is a 3x3 array
    if (!is_array($board) || count($board) !== 3) {
        return false;
    }
    foreach ($board as $row) {
        if (!is_array($row) || count($row) !== 3) {
            return false;
        }
        foreach ($row as $cell) {
            if (!in_array($cell, ['X', 'O', ''])) {
                return false;
            }
        }
    }
    return true;
}

function has_won($board, $player) {
    // Check rows
    for ($i = 0; $i < 3; $i++) {
        if ($board[$i][0] == $player && $board[$i][1] == $player && $board[$i][2] == $player) {
            return true;
        }
    }

    // Check columns
    for ($i = 0; $i < 3; $i++) {
        if ($board[0][$i] == $player && $board[1][$i] == $player && $board[2][$i] == $player) {
            return true;
        }
    }

    // Check diagonals
    if ($board[0][0] == $player && $board[1][1] == $player && $board[2][2] == $player) {
        return true;
    }
    if ($board[0][2] == $player && $board[1][1] == $player && $board[2][0] == $player) {
        return true;
    }

    return false;
}

function available_moves($board) {
    $moves = array();
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($board[$i][$j] != 'X' && $board[$i][$j] != 'O') {
                $moves[] = $board[$i][$j];
            }
        }
    }
    return $moves;
}

function game_is_over($board) {
    return has_won($board, 'X') || has_won($board, 'O') || count(available_moves($board)) == 0;
}

function evaluate_board($board) {
    if (has_won($board, 'X')) {
        return 1;
    } elseif (has_won($board, 'O')) {
        return -1;
    } else {
        return 0;
    }
}

// Get the current board state from the request parameters
$request_body = file_get_contents('php://input');
$current_board = json_decode($request_body, true);

// Validate the board data
if (!$current_board || !validate_board($current_board)) {
    // Return an error response if the board data is invalid
    //echo json_encode(array('error' => 'Invalid board data'));
    exit;
}

// Check if the game is over
if (game_is_over($current_board)) {
    // Determine the winner or if it's a draw
    $winner = has_won($current_board, 'X') ? 'X' : (has_won($current_board, 'O') ? 'O' : null);
    $draw = (!$winner && count(available_moves($current_board)) == 0) ? true : false;

    // Log the game outcome
    if ($winner) {
        logMove('Winner', $winner);
    } elseif ($draw) {
        logMove('Draw', 'N/A');
    }

    // Return the result as JSON
    echo json_encode(array(
        'result' => 'game_over',
        'winner' => $winner,
        'draw' => $draw
    ));
} else {
    // Continue the game
    echo json_encode(array(
        'result' => 'continue'
    ));
}
?>