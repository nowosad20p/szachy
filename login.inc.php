<?php
ob_start();
session_start();
require_once("functions.php");
if (!isset($_POST["submit"])) {
    header("Location:login.php");
}
$users = fopen("users.txt", "r");
while ($line = fgets($users)) {



    if ($_POST["login"] == trim(explode(" ", $line)[0])) {
        if (password_verify(trim($_POST["password"]), trim(explode(" ", $line)[1]))) {
            $_SESSION["user"] = $_POST["login"];
            header("Location:index.php");
        } else {


            header("Location:index.php?error=wrongPassword");
        }
    }
}

fclose($users);
