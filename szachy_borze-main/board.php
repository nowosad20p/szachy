<?php
require_once("functions.php");
require("chessPieces.php");
if($_GET["mode"]=="update"){
    changeParam("games/".$_GET["gameRoom"],"board",getParam("games/".$_GET["gameRoom"],"board")." ".$_GET["tresc"]);
}
if($_GET["mode"]=="get"){
echo $_GET["gameRoom"]."<br>";
$plansza=fopen("games/".$_GET["gameRoom"],"r");

while($line=fgets($plansza)){
if(explode(":",$line)[0]=="board"){
    echo explode(":",$line)[1];
}

}
var_dump(generateBoard());
fclose($plansza);
}
function generateBoard(){
    //tworzenie planszy i wczytywanie ruchów
    $board=[];
    for($i=0;$i<8;$i++){
        $new=[];
         for($j=0;$j<8;$j++){
             array_push($new,null);
         }
         array_push($board,$new);
    }
    for($i=0;$i<8;$i++){
        $board[$i][1]=new Pawn($i,1,"white");
        
    }
    for($i=0;$i<8;$i++){
        $board[$i][6]=new Pawn($i,6,"black");
        
    }

    $moves=getMovesArray();
    if($moves!=null){
    foreach($moves as $value){
        $board[$value[2]][$value[3]]=$board[$value[0]][$value[1]];
        $board[$value[0]][$value[1]]=null;
    }
}
    //zapis planszy do kodu html
    $html="<div class='board'>";
    $licznik=0;
    for($j=0;$j<8;$j++){
        for($i=0;$i<8;$i++){
            $piece="";
            $pieceColor=null;
            if(is_object($board[$i][$j])){
                $pieceColor=$board[$i][$j]->color;
            }            
            if($board[$i][$j] instanceof Pawn){
                $piece="Pawn";
            }
            if($board[$i][$j] instanceof Knight){
                $piece="Knight";
            }
            if($board[$i][$j] instanceof Bishop){
                $piece="Bishop";
            }
            if($board[$i][$j] instanceof Rook){
                $piece="Rook";
            }
            $pieceUrl="images/".$pieceColor.$piece.".png";
            
            if(($licznik+$j)%2==0){
                $html=$html."<div style=background-image:url('".$pieceUrl."') class='".$pieceColor.$piece." bialePole'></div>";
            }else{
                $html=$html."<div style=background-image:url('".$pieceUrl."') class='".$pieceColor.$piece." czarnePole'></div>";
            }
           
            $licznik++;
        }
    }
    
    $html=$html."</div>";
    
    return $html;
}


function getMovesArray(){
if(trim(getParam("games/".$_GET["gameRoom"],"board")==null)){
return null;
}


return explode(" ",getParam("games/".$_GET["gameRoom"],"board"));
}
?>