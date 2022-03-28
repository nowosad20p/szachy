<?php
$plansza=fopen("games/".$_GET["gameRoom"],"r");

echo fread($plansza,5);

fclose($plansza);

?>