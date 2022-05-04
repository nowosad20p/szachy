<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacje o koncie</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/account.css">
</head>
<body>
    
    <?php

include("nav.php");
include("functions.php");
$user=$_GET["user"];
echo"<h2>".$user."</h2>";
echo"<ul id='stats'>
<li>Mecze wygrane:".getParam("users/".$user."/accountData.txt","matchesWon")."</li>
<li>Mecze przegrane:".getParam("users/".$user."/accountData.txt","matchesLost")." </li>
<li>Mecze zremisowane:".getParam("users/".$user."/accountData.txt","matchesDraw")." </li>
</ul>";

?>
</body>
</html>
<?php
