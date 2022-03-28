<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
</head>
<body>
    <form action="createGame.php">
        <input type="submit" value="Stwórz grę" name="createGameBtn">
    </form>
    <form action="joinGame.php" method="GET">
    <input type="text" name="joinGameCode">
    <input type="submit" value="Dołącz do gry" name="joinGameBtn">
    </form>
</body>
</html>