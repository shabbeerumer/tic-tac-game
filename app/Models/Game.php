<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['board', 'current_player', 'winner', 'is_finished'];

    protected $casts = [
        'board' => 'array',
        'is_finished' => 'boolean',
    ];

    public function makeMove($position)
    {
        if ($this->is_finished || !is_null($this->winner)) {
            return false;
        }

        $board = $this->board;
        if ($position < 0 || $position > 8 || !is_null($board[$position])) {
            return false;
        }

        $board[$position] = $this->current_player;
        $this->board = $board;

        if ($this->checkWinner()) {
            $this->winner = $this->current_player;
            $this->is_finished = true;
        } elseif ($this->isBoardFull()) {
            $this->winner = 'draw';
            $this->is_finished = true;
        } else {
            $this->current_player = $this->current_player === 'X' ? 'O' : 'X';
        }

        $this->save();
        return true;
    }

    private function checkWinner()
    {
        $winningCombinations = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
            [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
            [0, 4, 8], [2, 4, 6]             // Diagonals
        ];

        foreach ($winningCombinations as $combination) {
            $line = array_map(fn($pos) => $this->board[$pos], $combination);
            if (count(array_unique($line)) === 1 && !is_null($line[0])) {
                return true;
            }
        }

        return false;
    }

    private function isBoardFull()
    {
        return !in_array(null, $this->board, true);
    }
} 