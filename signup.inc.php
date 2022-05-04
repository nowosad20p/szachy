<?php

$isTaken = false;


if (!$isTaken) {
   if(strlen(trim($_POST["password"]))>6&&strlen(trim($_POST["password"]))<16){
      mkdir("users/".$_POST["login"]);
      $accountData=fopen("users/".$_POST["login"]."/accountData.txt","c+");
      fwrite($accountData,"password:".password_hash($_POST["password"],PASSWORD_DEFAULT)."\n");
      
   header("Location:index.php?error=none");
   }else{
      header("Location:signup.php?error=wrongPassword");
   }
}
