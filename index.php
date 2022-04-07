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
    if (isset($_SESSION["user"])) {
        echo '<form action="createGame.php">
        <input type="submit" value="Stwórz grę" name="createGameBtn">
    </form>
    <form action="joinGame.php" method="GET">
    <input type="text" name="joinGameCode">
    <input type="submit" value="Dołącz do gry" name="joinGameBtn">
    </form>';
    } else {
        echo '<form action="login.php"><input type="submit" value="zaloguj się" name="zalogujBtn"></form>  <form action="signup.php"><input type="submit" value="zarejestruj się" name="zarejestrujBtn"></form>';
    }
    ?>
</body>

</html>