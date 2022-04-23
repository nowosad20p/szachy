<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
</head>

<body>

    <?php
    include("nav.php");
    ob_start();

    ?>
    <a href="gameForm.php" class="playIndex"><button class="importantButton">Zagraj</button></a>
    <?php
    include("footer.php");
    ob_start();

    ?>
</body>

</html>