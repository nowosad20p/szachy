<?php
error_reporting(0);
session_start();
include("functions.php");

if(isset($_GET["mode"])){
if($_GET["mode"]=="sendFriendRequest"){
    sendFriendRequest($_SESSION["user"],$_GET["secondUser"]);
}
if($_GET["mode"]=="friendRequestChoice"){
    if($_GET["choice"]=="accept"){
        addFriends($_SESSION["user"],$_GET["secondPlayer"]);
        removeLine("users/".$_SESSION["user"]."/friendRequests.txt",$_GET["secondPlayer"]);
    }else{
        removeLine("users/".$_SESSION["user"]."/friendRequests.txt",$_GET["secondPlayer"]);
    }
}
}
function sendFriendRequest($p1,$p2){
    $allPlayers=scandir("users");
    foreach($allPlayers as $value){
        if($value==$p2){
            file_put_contents("users/".$p2."/friendRequests.txt",$p1."\n",FILE_APPEND);
     
        }
        
    }
}
function addFriends($f1,$f2){
    $allPlayers=scandir("users");
    foreach($allPlayers as $value){
        if($value==$f1){
            file_put_contents("users/".$f1."/friendList.txt",$f2."\n",FILE_APPEND);
     
        }
        if($value==$f2){
            file_put_contents("users/".$f2."/friendList.txt",$f1."a\n",FILE_APPEND);
        
        }
    }
}
