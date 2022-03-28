<?php
$plansza=fopen("games/".$_GET["gameRoom"],"r");

echo fread($plansza,100);

fclose($plansza);

?>