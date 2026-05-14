<!DOCTYPE html>
<html>
    <head>
        <title>Kocke</title> 
        <link rel = "stylesheet" href = "style/styleIndex.css">
        <link rel="icon" href="img/favicon.png" type="image/png">
    </head>
    <body>
        <div id="main">
            <form method="post" action="game.php">
                <div id="table">
                    <div id = "player1"><label>Player 1: <input type="text" name="player1" class="small_input" required></label></div>
                    <div id="player2wrap"><div id = "player2"><label>Player 2:<input type="text" name="player2" class="small_input" required></label></div></div>
                    <div id = "player3"><label>Player 3: <input type="text" name="player3" class="small_input" required></label></div>
                </div>    

                <div id="bottom">
                    <div id="how_many">
                    <select type="number" name="roll_count" id="roll_count">
                        <option value="1">1 roll</option>
                        <option value="2">2 rolls</option>
                        <option value="3">3 rolls</option>
                    </select>
                    </div>
                    <div>
                        <button type="submit">Start</button>
                    </div>
                </div>
            </form>
            <button id="aboutButton" type="button">?</button>
        </div>  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetAlert.js"></script>
    </body>   
</html>
