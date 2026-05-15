<?php
session_start();

$players = [
    $_SESSION['player1'],
    $_SESSION['player2'],
    $_SESSION['player3']
];

$scores = $_SESSION['sumTab'];

$max = -1;
$second = -1;
$third = -1;

$winnerIndex = 0;
$secondIndex = 0;
$thirdIndex = 0;

for ($i = 0; $i < count($scores); $i++) {

    if ($scores[$i] > $max) {
        $third = $second;
        $thirdIndex = $secondIndex;

        $second = $max;
        $secondIndex = $winnerIndex;

        $max = $scores[$i];
        $winnerIndex = $i;
    } else if ($scores[$i] > $second) {
        $third = $second;
        $thirdIndex = $secondIndex;

        $second = $scores[$i];
        $secondIndex = $i;
    } else if ($scores[$i] > $third) {
        $third = $scores[$i];
        $thirdIndex = $i;
    }
}

$first = $players[$winnerIndex];
$second = $players[$secondIndex];
$third = $players[$thirdIndex];

?>

<!DOCTYPE html>
<html>

<head>
    <!--<meta http-equiv="refresh" content="10;url=index.php">-->
    <link rel="stylesheet" href="style/styleResult.css">
    <title>Dice-results</title>
    <link rel="icon" href="img/favicon.png" type="image/png">
</head>

<body>
    <img src="img/fireworks.gif" id="fireworks" alt="Fireworks">
    <div id="main">
        <div id="players">
            <div id="second">
                <?php echo $players[$secondIndex]; ?><br>
                Points: <?php echo $scores[$secondIndex]; ?>
            </div>

            <div id="first">
                <div id="name_first">
                    <?php echo $players[$winnerIndex]; ?><br>
                    Points: <?php echo $scores[$winnerIndex]; ?>
                </div>
            </div>

            <div id="third">
                <?php echo $players[$thirdIndex]; ?><br>
                Points: <?php echo $scores[$thirdIndex]; ?>
            </div>
        </div>
        <img src="img/podium.png" id="podium">
        <div id="countDownDiv">
            <p>Redirecting in <a id="countDown">10</a> seconds</p>
        </div>
    </div>
    <!--<script>
        let timeLeft = 10;
        const countDownElement = document.getElementById('countDown');

        const countDownInterval = setInterval(function() {
            timeLeft--;
            countDownElement.textContent = timeLeft;

            if (timeLeft <= 0) {
                clearInterval(countDownInterval);
                window.location.href = 'index.php'
            }
        }, 1000);
    </script>-->
</body>

</html>
