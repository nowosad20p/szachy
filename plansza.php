<?php
if($_GET["mode"]=="update"){
    $plansza=fopen("games/".$_GET["gameRoom"],"w");
    fwrite($plansza,$_GET["tresc"]);
    fclose($plansza);
}
echo $_GET["gameRoom"];
$plansza=fopen("games/".$_GET["gameRoom"],"r");

echo fread($plansza,100);

fclose($plansza);

?>