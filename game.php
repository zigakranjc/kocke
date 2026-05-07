<?php
session_start();

function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// reset
if (($_POST['action'] ?? '') === 'reset') {
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit;
}

// init from index submit (player names + roll_count)
if (isset($_POST['player1'], $_POST['player2'], $_POST['player3'], $_POST['roll_count'])) {
  $_SESSION['player1'] = (string)$_POST['player1'];
  $_SESSION['player2'] = (string)$_POST['player2'];
  $_SESSION['player3'] = (string)$_POST['player3'];

  $roll_count = (int)$_POST['roll_count'];
  if ($roll_count < 1) $roll_count = 1;
  if ($roll_count > 3) $roll_count = 3;
  $_SESSION['roll_count'] = $roll_count;

  $_SESSION['round'] = 0;
  $_SESSION['rolls'] = [[], [], []];
  $_SESSION['sumTab'] = [0, 0, 0];
}

$players = [
  $_SESSION['player1'] ?? '',
  $_SESSION['player2'] ?? '',
  $_SESSION['player3'] ?? '',
];

$roll_count = (int)($_SESSION['roll_count'] ?? 1);
if ($roll_count < 1) $roll_count = 1;
if ($roll_count > 3) $roll_count = 3;
$_SESSION['roll_count'] = $roll_count;

if (!isset($_SESSION['round'])) $_SESSION['round'] = 0;
if (!isset($_SESSION['rolls'])) $_SESSION['rolls'] = [[], [], []];
if (!isset($_SESSION['sumTab'])) $_SESSION['sumTab'] = [0, 0, 0];

$round = (int)$_SESSION['round'];
$done = $round >= $roll_count;

// 1 click = all 3 roll once (one round)
$want_roll = false;

// first arrival from index (no action field) -> treat as first roll
if (isset($_POST['player1'], $_POST['player2'], $_POST['player3'], $_POST['roll_count']) && !isset($_POST['action'])) {
  $want_roll = true;
}

// subsequent clicks on this page
if (($_POST['action'] ?? '') === 'roll') {
  $want_roll = true;
}

if ($want_roll && !$done) {
  for ($i = 0; $i < 3; $i++) {
    $roll = random_int(1, 6);
    $_SESSION['rolls'][$i][$round] = $roll;
    $_SESSION['sumTab'][$i] += $roll;
  }
  $_SESSION['round'] = $round + 1;

  $round = (int)$_SESSION['round'];
  $done = $round >= $roll_count;
}

$last = $round - 1;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Kocke</title>
    <link rel="stylesheet" href="style/styleIndex.css">
  </head>
  <body>
    <div id="main">
        <div id="table">
            <div id="player1">
            <div><?php echo h($players[0] !== '' ? $players[0] : 'Igralec 1'); ?></div>
            <?php if ($last >= 0): $r = (int)($_SESSION['rolls'][0][$last] ?? 0); ?>
                <?php if ($r): ?><img src="img/dice<?php echo $r; ?>.gif" alt="dice <?php echo $r; ?>"><?php endif; ?>
            <?php endif; ?>
            <div>Vsota: <?php echo (int)($_SESSION['sumTab'][0] ?? 0); ?></div>
            </div>

            <div id="player2wrap">
            <div id="player2">
                <div><?php echo h($players[1] !== '' ? $players[1] : 'Igralec 2'); ?></div>
                <?php if ($last >= 0): $r = (int)($_SESSION['rolls'][1][$last] ?? 0); ?>
                <?php if ($r): ?><img src="img/dice<?php echo $r; ?>.gif" alt="dice <?php echo $r; ?>"><?php endif; ?>
                <?php endif; ?>
                <div>Vsota: <?php echo (int)($_SESSION['sumTab'][1] ?? 0); ?></div>
            </div>
            </div>

            <div id="player3">
            <div><?php echo h($players[2] !== '' ? $players[2] : 'Igralec 3'); ?></div>
            <?php if ($last >= 0): $r = (int)($_SESSION['rolls'][2][$last] ?? 0); ?>
                <?php if ($r): ?><img src="img/dice<?php echo $r; ?>.gif" alt="dice <?php echo $r; ?>"><?php endif; ?>
            <?php endif; ?>
            <div>Vsota: <?php echo (int)($_SESSION['sumTab'][2] ?? 0); ?></div>
            </div>
        </div>

        <div id="bottom">
            <div id="roll">
            Met: <?php echo $round; ?> / <?php echo $roll_count; ?>
            </div>

            <div>
            <form method="post" action="game.php" style="display:inline;">
                <button type="submit" name="action" value="roll" <?php echo $done ? 'disabled' : ''; ?>>Vrzi</button>
            </form>

            <form method="post" action="game.php" style="display:inline;">
                <button type="submit" name="action" value="reset">Nova igra</button>
            </form>
            </div>
        </div> <!-- konec #bottom -->
    </div> <!-- konec #main -->
  </body>
</html>