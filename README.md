# Laravel Tic Tac Toe Game

A modern, responsive Tic Tac Toe game built with Laravel, featuring a beautiful UI with glassmorphism design.

## Features

- Real-time game updates
- Beautiful glassmorphism UI design
- Responsive layout for all devices
- Player turn tracking
- Win and draw detection
- Game state persistence using MySQL
- Smooth animations and transitions

## Technologies Used

- Laravel 11
- MySQL
- Bootstrap 5
- HTML5/CSS3
- JavaScript (ES6+)
- Animate.css

## Requirements

- PHP >= 8.2
- MySQL >= 5.7
- Composer
- Node.js & NPM (optional)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/shabbeerumer/tic-tac-game.git
cd tic-tac-game
```

2. Install dependencies:
```bash
composer install
```

3. Create and configure .env file:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tictacgame
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

7. Visit http://localhost:8000 in your browser

## How to Play

1. Click "Start New Game" to begin
2. Players take turns clicking on empty cells to place their X or O
3. The game automatically detects wins or draws
4. Click "New Game" at any time to start over

## Contributing

Feel free to fork this repository and submit pull requests. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

Shabbeer Umer
