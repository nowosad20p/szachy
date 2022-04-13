<?php
ob_start();
session_start();
require_once("functions.php");
require("chessPieces.php");
$board = getBoard();

if ($_GET["mode"] == "update") {
    if(getParam("games/" . $_GET["gameRoom"], "gameState")=="ongoing"){
    if (getParam("games/" . $_GET["gameRoom"], "player1") == $_SESSION["user"]) {
      
        if (getParam("games/" . $_GET["gameRoom"], "chosenPiece1") != null) {
            if (getParam("games/" . $_GET["gameRoom"], "currentmove") == "player1") {
                if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "black" || $board[$_GET["tresc"][0]][$_GET["tresc"][1]] == null) {
                   
                    $king=getKing("white");
                    $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1], $board);
                    foreach($avaibleMoves as $value){
                        if($value[0].$value[1]==$_GET["tresc"]){
                           
                       if(!$king[2]->isChecked($king[0],$king[1],getNewBoard(getParam("games/" . $_GET["gameRoom"], "chosenPiece1") . $_GET["tresc"]))){
                        changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " " . getParam("games/" . $_GET["gameRoom"], "chosenPiece1") . $_GET["tresc"]);
                        
                        changeParam("games/" . $_GET["gameRoom"], "currentmove", "player2");
                       }
                        }
                    }                   
                }
            }

            changeParam("games/" . $_GET["gameRoom"], "chosenPiece1", null);
        } else {

            if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "white") {
                if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]] != null) {
                    changeParam("games/" . $_GET["gameRoom"], "chosenPiece1", $_GET["tresc"]);
                }
            }
        }
    }
    if (getParam("games/" . $_GET["gameRoom"], "player2") == $_SESSION["user"]) {

        if (getParam("games/" . $_GET["gameRoom"], "chosenPiece2") != null) {
            if (getParam("games/" . $_GET["gameRoom"], "currentmove") == "player2") {
                if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "white" || $board[$_GET["tresc"][0]][$_GET["tresc"][1]] == null) {
                    $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1], $board);
                    foreach($avaibleMoves as $value){
                        if($value[0].$value[1]==$_GET["tresc"]){
                        changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " " . getParam("games/" . $_GET["gameRoom"], "chosenPiece2") . $_GET["tresc"]);
                        changeParam("games/" . $_GET["gameRoom"], "currentmove", "player1");
                   
                        }
                          
                       
                    }
                }
            }

            changeParam("games/" . $_GET["gameRoom"], "chosenPiece2", null);
        } else {

            if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "black") {
                if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]] != null) {
                    changeParam("games/" . $_GET["gameRoom"], "chosenPiece2", $_GET["tresc"]);
                }
            }
        }
    }
}
    if(!isAnyMovePossible("white")||!isAnyMovePossible("black")){
        changeParam("games/".$_GET["gameRoom"],"gameState","finished");
    }
}
if ($_GET["mode"] == "getBoard") {
    if($_SESSION["user"]==getParam("games/".$_GET["gameRoom"],"player1")){
    if(getParam("games/".$_GET["gameRoom"],"worthToUpdate1")=="true"){
        echo getParam("games/" . $_GET["gameRoom"], "board");
        changeParam("games/".$_GET["gameRoom"],"worthToUpdate1","false");
    }else{
        changeParam("games/".$_GET["gameRoom"],"worthToUpdate1","true");
      
    }
}else{
   
        if(getParam("games/".$_GET["gameRoom"],"worthToUpdate2")=="true"){
            echo getParam("games/" . $_GET["gameRoom"], "board");
            changeParam("games/".$_GET["gameRoom"],"worthToUpdate2","false");
        }else{
            changeParam("games/".$_GET["gameRoom"],"worthToUpdate2","true");
          
        }

}
}
if ($_GET["mode"] == "get") {


    if(getParam("games/" . $_GET["gameRoom"], "gameState")=="ongoing"){
        echo generateBoard();
    }
    if(getParam("games/" . $_GET["gameRoom"], "gameState")=="preparation"){
        echo "Oczekiwanie na drugiego gracza";
    }
    if(getParam("games/" . $_GET["gameRoom"], "gameState")=="finished"){
        echo "Gra się zakończyła";
    }
}
if($_GET["mode"]=="getKey"){
    echo $_GET["gameRoom"];
}
function getKing($color){
    $result=[null,null,null];
    $board=getBoard();
    for($i=0;$i<8;$i++){
        for($j=0;$j<8;$j++){
            if($board[$i][$j] instanceof King){
                if($board[$i][$j]->color==$color){
                    $result[0]=$i;
                    $result[1]=$j;
                    $result[2]=$board[$i][$j];
                    return $result;
                }
            }
        }
    }

    return null;
}
function getBoard()
{
    $board = [];
    for ($i = 0; $i < 8; $i++) {
        $new = [];
        for ($j = 0; $j < 8; $j++) {
            array_push($new, null);
        }
        array_push($board, $new);
    }
    for ($i = 0; $i < 8; $i++) {
        $board[$i][1] = new Pawn("white");
    }
    for ($i = 0; $i < 8; $i++) {
        $board[$i][6] = new Pawn("black");
    }
    $board[0][0] = new Rook("white");
    $board[1][0] = new Knight("white");
    $board[2][0] = new Bishop("white");
    $board[3][0] = new King("white");
    $board[4][0] = new Queen("white");
    $board[5][0] = new Bishop("white");
    $board[6][0] = new Knight("white");
    $board[7][0] = new Rook("white");

    $board[0][7] = new Rook("black");
    $board[1][7] = new Knight("black");
    $board[2][7] = new Bishop("black");
    $board[3][7] = new King("black");
    $board[4][7] = new Queen("black");
    $board[5][7] = new Bishop("black");
    $board[6][7] = new Knight("black");
    $board[7][7] = new Rook("black");


    $board=makeMoves($board, getMovesArray());


    
    return $board;
}
function makeMoves($board,$moves){
  
    if ($moves != null) {
        foreach ($moves as $value) {
            $board[$value[2]][$value[3]] = $board[$value[0]][$value[1]];
            $board[$value[0]][$value[1]] = null;
        }
    }
    return $board;
}
function generateBoard()
{
    //tworzenie planszy i wczytywanie ruchów
    $board = getBoard();
    //zapis planszy do kodu html
    $html = "";
    $licznik = 0;
    for ($j = 0; $j < 8; $j++) {
        for ($i = 0; $i < 8; $i++) {
            $piece = "none";
            $pieceColor = null;
            if (is_object($board[$i][$j])) {
                $pieceColor = $board[$i][$j]->color;
            }
            if ($board[$i][$j] instanceof Pawn) {
                $piece = "Pawn";
            }
            if ($board[$i][$j] instanceof Knight) {
                $piece = "Knight";
            }
            if ($board[$i][$j] instanceof Bishop) {
                $piece = "Bishop";
            }
            if ($board[$i][$j] instanceof Rook) {
                $piece = "Rook";
            }
            if ($board[$i][$j] instanceof Queen) {
                $piece = "Queen";
            }
            if ($board[$i][$j] instanceof King) {
                $piece = "King";
            }
            $pieceUrl = "images/" . $pieceColor . $piece . ".png";
            $specialClass = null;
            if (trim($i . "" . $j) == trim(getParam("games/" . $_GET["gameRoom"], "chosenPiece1")) && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player1")) {
                $specialClass = "aktywny";
            }
            if (trim($i . "" . $j) == trim(getParam("games/" . $_GET["gameRoom"], "chosenPiece2")) && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player2")) {
                $specialClass = "aktywny";
            }
            if (getParam("games/" . $_GET["gameRoom"], "chosenPiece1") != null && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player1")) {
                $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1], $board);
                foreach ($avaibleMoves as $value) {
                   
                    if ($value[0] . $value[1] == $i . $j) {
                        $specialClass = "mozliwy";
                    }
                }
            }

            if (isMovePossible($i, $j, $board)) {
                $specialClass = "mozliwy";
            }
            if (($licznik + $j) % 2 == 0) {
                $html = $html . "<div style=background-image:url('" . $pieceUrl . "') class='" . $pieceColor . $piece . " " . $specialClass . " bialePole' id='" . $i . $j . "'.></div>";
            } else {
                $html = $html . "<div style=background-image:url('" . $pieceUrl . "') class='" . $pieceColor . $piece . " " . $specialClass . " czarnePole' id='" . $i . $j . "'></div>";
            }

            $licznik++;
        }
    }

   

    return $html;
}

function isMovePossible($posX, $posY, $board)
{
    if (getParam("games/" . $_GET["gameRoom"], "chosenPiece2") != null && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player2")) {
        $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1], $board);
        foreach ($avaibleMoves as $value) {
            
            if ($value[0] . $value[1] == $posX . $posY) {
                return true;
            }
        }
    }
    return false;
}
function isAnyMovePossible($color){
    $board=getBoard();
    for($i=0;$i<8;$i++){
        for($j=0;$j<8;$j++){
            if($board[$i][$j]!=null){
                if($board[$i][$j]->color==$color){
                    $avaibleMoves =$board[$i][$j]->getAvaibleMoves($i,$j,$board);
                     if(count($avaibleMoves)>0){
                         return true;
                     }
                }
            }
        }
    }
    return false;
}
function getMovesArray()
{
    if (trim(getParam("games/" . $_GET["gameRoom"], "board") == null)) {
        return null;
    }


    return explode(" ", getParam("games/" . $_GET["gameRoom"], "board"));
}
function getNewBoard($move){
$board2=getBoard();
$board2[$move[2]][$move[3]]=$board2[$move[0]][$move[1]];
$board2[$move[0]][$move[1]]=null;
return $board2;
}
