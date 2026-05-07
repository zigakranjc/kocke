<!DOCTYPE html>
<html>
    <head>
        <title>Kocke</title> 
        <link rel = "stylesheet" href = "style/styleIndex.css">
    </head>
    <body>
        <div id="main">
            <form method="post" action="game.php">
                <div id="table">
                    <div id = "player1"><label>Igralec 1: <input type="text" name="player1" class="small_input"></label></div>
                    <div id="player2wrap"><div id = "player2"><label>Igralec 2: <br /><input type="text" name="player2" class="small_input"></label></div></div>
                    <div id = "player3"><label>Igralec 3: <input type="text" name="player3" class="small_input"></label></div>
                </div>    

                <div id="bottom">
                    <div id="roll">
                    <select type="number" name="roll_count" id="roll_count">
                        <option value="1">1 met</option>
                        <option value="2">2 meta</option>
                        <option value="3">3 mete</option>
                    </select>
                    </div>
                    <div>
                        <button type="submit">Vrzi kocke</button>
                    </div>
                </div>
            </form>
        </div>  
    </body>   
</html>
