<h1 align="center">🎲 Dice Game</h1>

A simple multiplayer dice game built with **PHP**, **HTML**, and **CSS**.

Players roll dice for a selected number of rounds, collect points, and compare results at the end of the game.

## Features

- 3-player support
- Custom player names
- Custom number of rounds
- Automatic first roll when game starts
- Random dice rolls using PHP `random_int()`
- Live score tracking
- Session-based game state
- Results screen after all rounds are completed
- Reset and restart functionality

## How It Works

1. Enter names for 3 players.
2. Choose the number of rounds.
3. Start the game.
4. Each round:
   - Click **ROLL**
   - Every player rolls one dice
   - Points are added automatically
5. After all rounds are completed:
   - Click **RESULTS**
   - View final scores and winner

## Technologies Used

- PHP
- HTML5
- CSS3
- PHP Sessions

## Project Structure

```bash
project/
│
├── index.php          # Start page / player setup
├── game.php           # Main game logic
├── result.php         # Final results page
│
├── style/
│   ├── styleGame.css
│   └── ...
│
├── img/
│   ├── dice1.gif
│   ├── dice2.gif
│   ├── dice3.gif
│   ├── dice4.gif
│   ├── dice5.gif
│   └── dice6.gif
```

## Installation

1. Clone repository:

```bash
git clone https://github.com/yourusername/dice-game.git
```

2. Move project into your web server folder:

For XAMPP:
```bash
htdocs/dice-game
```

3. Start Apache.

4. Open in browser:

```bash
http://localhost/dice-game
```

## Game Logic

- Each player rolls a number from **1–6**
- Rolls are generated with:

```php
random_int(1, 6);
```

- Results are stored in PHP sessions:

```php
$_SESSION['rolls']
$_SESSION['sumTab']
$_SESSION['round']
```

## License

This project is open source and available under the MIT License.

<p align="center"><b>Developed by Žiga Kranjc</b></p>
