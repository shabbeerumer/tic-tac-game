<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    public function create()
    {
        $game = Game::create([
            'board' => array_fill(0, 9, null),
            'current_player' => 'X',
            'winner' => null,
            'is_finished' => false
        ]);
        
        return redirect()->route('game.show', $game);
    }

    public function show(Game $game)
    {
        return view('game.show', compact('game'));
    }

    public function makeMove(Request $request, Game $game)
    {
        $position = $request->input('position');
        
        if (!is_numeric($position) || $position < 0 || $position > 8) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid position'
            ], 400);
        }

        $success = $game->makeMove($position);
        
        return response()->json([
            'success' => $success,
            'board' => $game->board,
            'currentPlayer' => $game->current_player,
            'winner' => $game->winner,
            'isFinished' => $game->is_finished
        ]);
    }
} 