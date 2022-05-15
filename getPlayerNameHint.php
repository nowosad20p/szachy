<?php
session_start();
$allPlayers=scandir("users");
if(strlen($_GET["cur"])>0){
foreach($allPlayers as $value){
    if (strpos($value, $_GET["cur"]) !== false && $value!=$_SESSION["user"]) {
       echo "<li><input type=button value='".$value."' class='addFriendBtn'></li>";
   }
}
}else{
    echo "brak wyników";
}