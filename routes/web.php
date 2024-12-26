<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GameController::class, 'index'])->name('game.index');
Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
Route::get('/game/{game}', [GameController::class, 'show'])->name('game.show');
Route::post('/game/{game}/move', [GameController::class, 'makeMove'])->name('game.move');
