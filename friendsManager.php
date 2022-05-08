<?php
function addFriends($f1,$f2){
    $allPlayers=scandir("users");
    foreach($allPlayers as $value){
        if($value==$f1){
            file_put_contents("users/".$f1."/friendList.txt",$f2."\n",FILE_APPEND);
     
        }
        if($value==$f2){
            file_put_contents("users/".$f2."/friendList.txt",$f1."\n",FILE_APPEND);
        
        }
    }
}
