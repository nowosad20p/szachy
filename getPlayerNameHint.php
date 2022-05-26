<?php
session_start();
require("functions.php");

$allPlayers = scandir("users");
if (strlen($_GET["cur"]) > 0) {
    foreach ($allPlayers as $value) {
            if($value!=".htaccess"){
        if (strpos($value, $_GET["cur"]) !== false && $value != $_SESSION["user"]) {
            if (!doesFileInclude("users/" . $_SESSION["user"] . "/friendList.txt", $_GET["cur"])) {
                echo "<li><input type=button value='" . $value . "' class='addFriendBtn'></li>";
            }
        }
            }
    }
} else {
    echo "brak wyników";
}
