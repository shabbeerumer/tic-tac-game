@extends('layouts.app')

@section('content')
<div class="game-container animate__animated animate__fadeIn">
    <div class="text-center mb-4">
        <h2 class="h3 mb-4">Game #{{ $game->id }}</h2>
        <div class="game-status" id="gameStatus">
            Current Player: <span class="badge {{ $game->current_player === 'X' ? 'badge-x' : 'badge-o' }}">{{ $game->current_player }}</span>
        </div>
    </div>

    <div class="game-board">
        @foreach($game->board as $index => $value)
            <div class="cell {{ $value ? strtolower($value) : '' }}" 
                 data-position="{{ $index }}"
                 @if(!$value && !$game->is_finished) style="cursor: pointer;" @endif>
                {{ $value }}
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('game.create') }}" class="btn btn-custom">
            Start New Game
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cells = document.querySelectorAll('.cell');
    const gameStatus = document.getElementById('gameStatus');
    let isFinished = {{ $game->is_finished ? 'true' : 'false' }};

    cells.forEach(cell => {
        cell.addEventListener('click', async function() {
            if (isFinished || cell.textContent.trim()) return;

            const position = cell.dataset.position;
            try {
                const response = await fetch('{{ route('game.move', $game) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ position: parseInt(position) })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                if (data.success) {
                    cell.textContent = data.board[position];
                    cell.className = `cell ${data.board[position].toLowerCase()} animate-pop`;
                    
                    updateStatus(data.currentPlayer, data.winner, data.isFinished);
                    isFinished = data.isFinished;
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });

    function updateStatus(currentPlayer, winner, isFinished) {
        if (winner) {
            if (winner === 'draw') {
                gameStatus.innerHTML = `
                    <div class="winner-message animate__animated animate__bounceIn">
                        Game Over - It's a Draw!
                    </div>`;
            } else {
                gameStatus.innerHTML = `
                    <div class="winner-message animate__animated animate__bounceIn">
                        Game Over - Player <span class="badge ${winner === 'X' ? 'badge-x' : 'badge-o'}">${winner}</span> Wins!
                    </div>`;
            }
        } else {
            gameStatus.innerHTML = `
                Current Player: <span class="badge ${currentPlayer === 'X' ? 'badge-x' : 'badge-o'}">${currentPlayer}</span>
            `;
        }
    }
});
</script>
@endpush 