<?php
$users = fopen("users.txt", "r");
$isTaken = false;
while ($line = fgets($users)) {

   if ($_POST["login"] == explode(" ", $line)[0]) {
      fclose($users);
      header("Location:signup.php?error=usernameTaken");
      $isTaken = true;
   }
}
fclose($users);

if (!$isTaken) {
   if(strlen(trim($_POST["password"]))>6&&strlen(trim($_POST["password"]))<16){

   file_put_contents("users.txt", "\n" . $_POST["login"] . " " . password_hash(trim($_POST["password"]), PASSWORD_DEFAULT), FILE_APPEND);
   header("Location:index.php?error=none");
   }else{
      header("Location:signup.php?error=wrongPassword");
   }
}
