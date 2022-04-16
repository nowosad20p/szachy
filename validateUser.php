<?php
require("functions.php");
$users = fopen("users.txt", "r"); 
while ($line = fgets($users)) {



    if ($_SESSION["user"] == trim(explode(" ", $line)[0])) {
        if (password_verify(trim($_SESSION["password"]), trim(explode(" ", $line)[1]))) {
            
            
            
        } else {


            header("Location:login.php?error=wrongPassword");
        }
    }
}