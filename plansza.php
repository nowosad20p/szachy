<?php
$plansza=fopen("plansza.txt","r");

echo fread($plansza,5);

fclose($plansza);

?>