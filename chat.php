<?php
session_start();
ob_start();
if ($_GET["mode"] == "get") {
    $file = fopen("chats/" . $_GET["gameRoom"] . "-chat", "r");
    while ($line = fgets($file)) {
        echo "<p class='mesage'>" . $line . "</p>";
    }
    fclose($file);
}
if ($_GET["mode"] == "update") {

    file_put_contents("chats/" . $_GET["gameRoom"] . "-chat", PHP_EOL . $_SESSION["user"] . ":" . $_GET["tresc"], FILE_APPEND);
}
