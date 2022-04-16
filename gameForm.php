<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    
    <?php
    require_once("nav.php");
    ob_start();
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location:index.php");
    }

    ?>
    <h1>Graj w gre</h1>
    <main id="gameFormContainer">
    <form action="createGame.php">
        <h2>Stwórz grę</h2>
        <input type="submit" value="Stwórz grę" name="createGameBtn">
        <label for="isGamePrivate">Prywatna gra</label><input type="checkbox" name="isGamePrivate">
    </form>
    <form action="joinGame.php" method="GET">
        <h2>Dołącz do gry</h2>
    <input type="text" name="joinGameCode">
    <input type="submit" value="Dołącz do gry" name="joinGameBtn">
    </form>
    <div id="spisGier">
        <h2>Dołącz do otwartych gier</h2>
        <ul>
    <?php
    require_once("functions.php");
    $allGames=scandir("games");
    foreach($allGames as $value){
        if(strlen($value)==5){
        if(getParam("games/".$value,"roomStatus")=="public"){
            if(getParam("games/".$value,"player1"==null||getParam("games/".$value,"player2")==null)){
            echo "<li><a href=game.php?gameRoom=".$value.">Pokój".$value."</a></li>";
            }
        }
    }
    }

    
    ?>
    <li><a href="gameForm.php">Odśwież</a></li>
    </ul>
    </div>
    </main>
</body>

</html>