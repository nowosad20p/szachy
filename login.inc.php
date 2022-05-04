<?php
ob_start();
session_start();
require_once("functions.php");
if (!isset($_POST["submit"])) {
    header("Location:login.php");
}
$loginFound=false;
$users = scandir("users");
foreach($users as $value){
    if($value==$_POST["login"]){
        if(password_verify($_POST["password"],trim(getParam("users/".$_POST["login"]."/accountData.txt","password")))){
           $_SESSION["user"]=$_POST["login"];
           header("Location:index.php?error=none");
        }else{
            header("Location:index.php?error=".$_POST["login"].getParam("users/".$_POST["login"]."/accountData.txt","password"));
        }
    }
}

