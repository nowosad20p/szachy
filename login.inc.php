<?php
ob_start();
session_start();
require_once("functions.php");
if (!isset($_POST["submit"])) {
    header("Location:login.php");
}
$loginFound=false;
$users = fopen("users.txt", "r");
while ($line = fgets($users)) {



    if ($_POST["login"] == trim(explode(" ", $line)[0])) {
        $loginFound=true; 
        if (password_verify(trim($_POST["password"]), trim(explode(" ", $line)[1]))) {
            $_SESSION["user"] = $_POST["login"];
            $_SESSION["password"] = $_POST["password"];
            header("Location:index.php");
        } else {


            header("Location:login.php?error=wrongPassword");
        }
    }
}
if(!$loginFound){
    header("Location:login.php?error=wrongUsername");
}
fclose($users);
