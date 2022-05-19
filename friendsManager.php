<?php
error_reporting(0);
session_start();
include("functions.php");

if (isset($_GET["mode"])) {
    if ($_GET["mode"] == "sendFriendRequest") {
        sendFriendRequest($_SESSION["user"], $_GET["secondUser"]);
    }
    if ($_GET["mode"] == "friendRequestAccept") {

        addFriends($_SESSION["user"], $_GET["secondPlayer"]);
        removeLine("users/" . $_SESSION["user"] . "/friendRequests.txt", $_GET["secondPlayer"]);
    }
    if ($_GET["mode"] == "friendRequestReject") {


        removeLine("users/" . $_SESSION["user"] . "/friendRequests.txt", $_GET["secondPlayer"]);
    }
}
function sendFriendRequest($p1, $p2)
{
    if (!doesFileInclude("users/" . $p2 . "/friendRequests.txt", $p1) && !doesFileInclude("users/" . $p2 . "/friendList.txt", $p1)) {
        $allPlayers = scandir("users");
        foreach ($allPlayers as $value) {
            if ($value == $p2) {
                file_put_contents("users/" . $p2 . "/friendRequests.txt", $p1 . "\n", FILE_APPEND);
            }
        }
    }
}
function addFriends($f1, $f2)
{
    if (!doesFileInclude("users/" . $f2 . "/friendList.txt", $f1)) {
        $allPlayers = scandir("users");
        foreach ($allPlayers as $value) {
            if ($value == $f1) {
                file_put_contents("users/" . $f1 . "/friendList.txt", $f2 . "\n", FILE_APPEND);
            }
            if ($value == $f2) {
                file_put_contents("users/" . $f2 . "/friendList.txt", $f1 . "\n", FILE_APPEND);
            }
        }
    }
}
