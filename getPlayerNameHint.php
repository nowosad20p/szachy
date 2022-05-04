<?php
$allPlayers=scandir("users");
if(strlen($_GET["cur"])>0){


foreach($allPlayers as $value){
    if (strpos($value, $_GET["cur"]) !== false) {
       echo "<li><span>".$value."</span><input type=button value='dodaj' class='addFriendBtn'></li>";
   }
}
}else{
    echo "brak wyników";
}