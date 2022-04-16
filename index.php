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
    ?>
    <a href="gameForm.php"><button>Zagraj</button></a>
</body>

</html>