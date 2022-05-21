<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/formStyle.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>

<body>

    <?php
    require_once("nav.php");
    ob_start();

    if (!isset($_SESSION["user"])) {
        header("Location:index.php");
    }

    ?>

    <main id="gameFormContainer">
        <form action="createGame.php">
            <h2>Stwórz grę</h2>

            <label for="isGamePrivate">Prywatna gra<input type="checkbox" name="isGamePrivate"></label>
            <div id="friendSelectContainer">
                <label for="friendListChk">Wyślij zaproszenie znajomemu:</label><input type="checkbox" id="friendListChk" name="friendListChk">
                <select id="friendSelect" name="friendSelect">
                    <?php
                    $friends = fopen("users/" . $_SESSION["user"] . "/friendList.txt", "r");
                    while ($value = fgets($friends)) {
                        echo "<option>" . $value . "</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Stwórz grę" name="createGameBtn" class="importantButton">
        </form>
        <form action="joinGame.php" method="GET">
            <h2>Dołącz do gry</h2>
            <label for="joinGameCode">Kod gry:<br><input type="text" name="joinGameCode"></label>
            <input type="submit" value="Dołącz do gry" name="joinGameBtn" class="importantButton">
        </form>
        <hr>
        <div class="spisGier">
            <h2>Dołącz do otwartych gier</h2>
            <ul>
                <?php
                require_once("functions.php");
                $allGames = scandir("games");
                foreach ($allGames as $value) {
                    if (strlen($value) == 5) {
                        if (getParam("games/" . $value, "roomStatus") == "public") {
                            if (getParam("games/" . $value, "player1") == null || getParam("games/" . $value, "player2") == null) {
                                echo "<li><a href=game.php?gameRoom=" . $value . ">Pokój " . $value . " |  Gracz: " . getParam("games/" . $value, "player1") . "</a></li>";
                            }
                        }
                    }
                }


                ?>

            </ul>
            <a class="refresh" href="gameForm.php">Odśwież</a>
        </div>
        <div class="spisGier">
            <h2>Kontynuuj swoje gry</h2>
            <ul>
                <?php
                require_once("functions.php");
                $allGames = scandir("games");
                foreach ($allGames as $value) {
                    if (strlen($value) == 5) {
                        if (getParam("games/" . $value, "player1") == $_SESSION["user"] || getParam("games/" . $value, "player2") == $_SESSION["user"]) {
                            if (getParam("games/" . $value, "player1") == $_SESSION["user"]) {
                                echo "<li><a href=game.php?gameRoom=" . $value . ">Pokój " . $value . " |  Przeciwnik: " . getParam("games/" . $value, "player2") . "</a></li>";
                            } else {
                                echo "<li><a href=game.php?gameRoom=" . $value . ">Pokój " . $value . " |  Przeciwnik: " . getParam("games/" . $value, "player1wD") . "</a></li>";
                            }
                        }
                    }
                }


                ?>

            </ul>
            <a class="refresh" href="gameForm.php">Odśwież</a>
        </div>

    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>