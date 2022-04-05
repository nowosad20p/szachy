<?php

require_once("functions.php");
require("chessPieces.php");
$board=[];

if($_GET["mode"]=="update"){
    if(getBoard()[$_GET["tresc"][0]][$_GET["tresc"][1]]!=null){
        changeParam("games/".$_GET["gameRoom"],"board",getParam("games/".$_GET["gameRoom"],"board")." ".$_GET["tresc"]);
    }
    
    
}
if($_GET["mode"]=="getBoard"){
    echo getParam("games/".$_GET["gameRoom"],"board");
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
function getBoard(){
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
    $board[0][0]=new Rook(0,0,"white");
    $board[1][0]=new Knight(1,0,"white");
    $board[2][0]=new Bishop(2,0,"white");
    $board[3][0]=new King(3,0,"white");
    $board[4][0]=new Queen(4,0,"white");
    $board[5][0]=new Bishop(5,0,"white");
    $board[6][0]=new Knight(6,0,"white");
    $board[7][0]=new Rook(7,0,"white");

    $board[0][7]=new Rook(0,0,"black");
    $board[1][7]=new Knight(1,0,"black");
    $board[2][7]=new Bishop(2,0,"black");
    $board[3][7]=new King(3,0,"black");
    $board[4][7]=new Queen(4,0,"black");
    $board[5][7]=new Bishop(5,0,"black");
    $board[6][7]=new Knight(6,0,"black");
    $board[7][7]=new Rook(7,0,"black");




    
    $moves=getMovesArray();
    if($moves!=null){
    foreach($moves as $value){
        $board[$value[2]][$value[3]]=$board[$value[0]][$value[1]];
        $board[$value[0]][$value[1]]=null;
    }

}
return $board;
}
function generateBoard(){
    //tworzenie planszy i wczytywanie ruchów
   $board=getBoard();
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
            if($board[$i][$j] instanceof Queen){
                $piece="Queen";
            }
            if($board[$i][$j] instanceof King){
                $piece="King";
            }
            $pieceUrl="images/".$pieceColor.$piece.".png";
            
            if(($licznik+$j)%2==0){
                $html=$html."<div style=background-image:url('".$pieceUrl."') class='".$pieceColor.$piece." bialePole' id='".$i.$j."'.></div>";
            }else{
                $html=$html."<div style=background-image:url('".$pieceUrl."') class='".$pieceColor.$piece." czarnePole' id='".$i.$j."'></div>";
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

