<?php
require_once("functions.php");
if($_GET["mode"]=="update"){
    changeParam("games/".$_GET["gameRoom"],"board",$_GET["tresc"]);
}
if($_GET["mode"]=="get"){
echo $_GET["gameRoom"]."<br>";
$plansza=fopen("games/".$_GET["gameRoom"],"r");

while($line=fgets($plansza)){
if(explode(":",$line)[0]=="board"){
    echo explode(":",$line)[1];
}

}

fclose($plansza);
}

?>