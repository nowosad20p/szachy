<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/formstyle.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>

<body>
    <?php
    include("nav.php");

    ?>
    <form action="login.inc.php" method="POST">
        <h2>Logowanie</h2>
        <label for="login">Nazwa użytkownika:</label>
        <input type="text" name="login">
        <label for="login">Hasło:</label>
        <input type="password" name="password">
        <input type="submit" name="submit">
        <a href="signup.php">Nie masz konta? Zarejestruj się</a>
        <p>
    <?php
    if(isset($_GET["error"])){
        if($_GET["error"]=="wrongUsername"){
            echo "niewłaściwy login";
        }
        if($_GET["error"]=="wrongPassword"){
            echo "niewłaściwe hasło";
        }
    }
    ?>
    </p>
    </form>
    
</body>

</html>