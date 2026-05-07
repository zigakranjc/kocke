<?php
    session_start();

    $players = [$_SESSION['player1'], $_SESSION['player2'], $_SESSION['player3']];
    $rolls   = $_SESSION['rolls'];
    $sumTab  = $_SESSION['sumTab'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>game</title>
    </head>
    <body>
        <?php
echo "<pre>";
var_dump($_SESSION["player1"], $_SESSION["player2"], $_SESSION["player3"]);
var_dump($_SESSION["rolls"]);
var_dump($sumTab);
echo "</pre>";
?>
    </body>
</html>