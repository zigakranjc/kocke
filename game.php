<?php
session_start();
$roll_count = $_SESSION['roll_count'] ?? 1;
$round = $_SESSION['round'] ?? 0;
function h(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// reset
if (($_POST['action'] ?? '') === 'reset') {
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit;
}

// če so playeri in število metov nastavljeni, se ustvari session
if (isset($_POST['player1'], $_POST['player2'], $_POST['player3'], $_POST['roll_count'])) {
  $_SESSION['player1'] = (string)$_POST['player1'];
  $_SESSION['player2'] = (string)$_POST['player2'];
  $_SESSION['player3'] = (string)$_POST['player3'];

  $roll_count = (int)$_POST['roll_count']; //pobere število metov iz forme in jih pretvori v int
  $_SESSION['roll_count'] = $roll_count; // število metov da v session

  $_SESSION['round'] = 0; 
  $_SESSION['rolls'] = [[], [], []]; //igralci in njihovi meti
  $_SESSION['sumTab'] = [0, 0, 0]; //vsota točk

  // ko se začne nova igra resetiraš te dve spremenljivki
  $round = 0;
  $done = false;
}

$players = [
  $_SESSION['player1'],
  $_SESSION['player2'],
  $_SESSION['player3'],
];

$done = $round >= $roll_count; //preveri če je igra končana

// met kocke
$roll_dice = false;

// avtomatsko vrzi prvi met ko igralec prvič pride v igro
if (isset($_POST['player1'], $_POST['player2'], $_POST['player3'], $_POST['roll_count']) && !isset($_POST['action'])) {
  $roll_dice = true;
}

// ko kliknemo roll se kocke vržejo; ?? '' - ker za prvi roll ne kliknemo gumba to naredi, da se vržejo tudi brez action
if (($_POST['action'] ?? '') === 'roll') {
  $roll_dice = true;
}

// če je met krogle in igra ni končana gremo skozi tabelo igralcev in za vsakega dobimo random stevilo, ga shranimo v session in povečamo vsoto točk. Povečamo še število rund in potem ponastavimo spremenljivke
if ($roll_dice && !$done) {
  for ($i = 0; $i < 3; $i++) {
    $roll = random_int(1, 6);
    $_SESSION['rolls'][$i][$round] = $roll;
    $_SESSION['sumTab'][$i] += $roll;
  }
  $_SESSION['round']++;

  $round = (int)($_SESSION['round'] ?? 0);
    $roll_count = (int)($_SESSION['roll_count'] ?? 1);

    $done = $round >= $roll_count;
}

$round = $_SESSION['round'] ?? 0;
$last = ($_SESSION['round'] ?? 0) - 1;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Kocke</title>
    <link rel="stylesheet" href="style/styleGame.css">
  </head>
  <body>
    <div id="main">
        <div id="table">
            <div id="player1">
                <div class="name">
                    <?php echo h($players[0] !== '' ? $players[0] : 'Igralec 1'); ?>
                </div>
                <div class="sum">
                    Vsota: <?php echo (int)($_SESSION['sumTab'][0] ?? 0); ?>
                </div>
            </div>
            <div>
                 <?php if ($last >= 0): $zadnji_met = $_SESSION['rolls'][0][$last] ?? 0; ?>
                <?php if ($zadnji_met): ?><img src="img/dice<?php echo $zadnji_met; ?>.gif" alt="dice <?php echo $zadnji_met; ?>"><?php endif; ?>
                <?php endif; ?>
            </div>

            <div id="player2wrap">
                <div>
                    <?php if ($last >= 0): $zadnji_met = $_SESSION['rolls'][1][$last] ?? 0; ?>
                    <?php if ($zadnji_met): ?><img src="img/dice<?php echo $zadnji_met; ?>.gif" alt="dice <?php echo $zadnji_met; ?>"><?php endif; ?>
                    <?php endif; ?>
                </div>
                <div id="player2">
                    <div class="name">
                        <?php echo h($players[1] !== '' ? $players[1] : 'Igralec 2'); ?>
                    </div>
                    <div class="sum">
                        Vsota: <?php echo (int)($_SESSION['sumTab'][1] ?? 0); ?>
                    </div>
                </div>
                
            </div>
            
            <div>
                <?php if ($last >= 0): $zadnji_met = $_SESSION['rolls'][2][$last] ?? 0; ?>
                <?php if ($zadnji_met): ?><img src="img/dice<?php echo $zadnji_met; ?>.gif" alt="dice <?php echo $zadnji_met; ?>"><?php endif; ?>
                <?php endif; ?>
            </div>
            <div id="player3">
                <div class="name">
                    <?php echo h($players[2] !== '' ? $players[2] : 'Igralec 3'); ?>
                </div>
                <div class="sum">
                    Vsota: <?php echo (int)($_SESSION['sumTab'][2] ?? 0); ?>
                </div>
            </div>
        </div>

        <div id="bottom">
            <div id="roll">
            Roll: <?php echo $round; ?> / <?php echo $roll_count; ?>
            </div>

            <div>
                <form method="post" action="game.php" style="display:inline;">
                    <button type="submit" name="action" value="roll" <?php echo $done ? 'disabled' : ''?>>ROLL</button>     
                </form>

                <form method="post" action="result.php" style="display:inline;">
                    <button type="submit" name="action" value="reset">RESULTS</button>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
