<?php

$isTaken = false;


if (!$isTaken) {
   if(strlen(trim($_POST["password"]))>6&&strlen(trim($_POST["password"]))<16){
      mkdir("users/".$_POST["login"]);
      $accountData=fopen("users/".$_POST["login"]."/accountData.txt","c+");
       fopen("users/".$_POST["login"]."/friendRequests.txt","c");
       fopen("users/".$_POST["login"]."/friendList.txt","c");
       fopen("users/".$_POST["login"]."/gameInvites.txt","c");
      fwrite($accountData,"password:".password_hash($_POST["password"],PASSWORD_DEFAULT)."\nmatchesWon:0\nmatchesDraw:0\nmatchesLost:0\n");
      fclose($accountData);
   header("Location:index.php?error=none");
   }else{
      header("Location:signup.php?error=wrongPassword");
   }
}
