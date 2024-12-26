@extends('layouts.app')

@section('content')
<div class="game-container animate__animated animate__fadeIn">
    <div class="text-center">
        <h1 class="display-4 mb-4 fw-bold">Welcome to Tic Tac Toe!</h1>
        <p class="lead mb-5">Challenge your friends to an exciting game of Tic Tac Toe. 
            <br>Show your strategic skills and aim for victory!</p>
        
        <div class="row justify-content-center mb-5">
            <div class="col-md-4">
                <div class="card bg-transparent border-light mb-3">
                    <div class="card-body text-center">
                        <h3 class="h5 mb-3">Player X</h3>
                        <div class="display-1 mb-3 text-danger">X</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-transparent border-light mb-3">
                    <div class="card-body text-center">
                        <h3 class="h5 mb-3">Player O</h3>
                        <div class="display-1 mb-3 text-info">O</div>
                    </div>
                </div>
            </div>
        </div>
        
        <a href="{{ route('game.create') }}" class="btn btn-custom btn-lg animate__animated animate__pulse animate__infinite">
            Start New Game
        </a>
    </div>
</div>

<div class="text-center mt-5">
    <p class="text-white-50">Made with ❤️ using Laravel & Bootstrap</p>
</div>
@endsection 