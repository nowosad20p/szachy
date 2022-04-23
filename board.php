<?php
ob_start();
session_start();
include("validateUser.php");
require_once("functions.php");
require("chessPieces.php");
$board = getBoard();

if ($_GET["mode"] == "update") {
    if (getParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice")[0] != "t") {

        if (getParam("games/" . $_GET["gameRoom"], "gameState") == "ongoing") {
            if (getParam("games/" . $_GET["gameRoom"], "player1") == $_SESSION["user"]) {

                if (getParam("games/" . $_GET["gameRoom"], "chosenPiece1") != null) {
                    if (getParam("games/" . $_GET["gameRoom"], "currentmove") == "player1") {
                        if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "black" || $board[$_GET["tresc"][0]][$_GET["tresc"][1]] == null) {


                            $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1], $board);
                            foreach ($avaibleMoves as $value) {
                                if ($value[0] . $value[1] == $_GET["tresc"]) {
                                    $move = getParam("games/" . $_GET["gameRoom"], "chosenPiece1") . $_GET["tresc"];
                                    if (isMoveLegal("white", $move)) {
                                        changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " " . getParam("games/" . $_GET["gameRoom"], "chosenPiece1") . $_GET["tresc"]);
                                        if ($board[$move[0]][$move[1]] instanceof King) {
                                            if ($move[0] - $move[2] == 2) {
                                                changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " 0020");
                                            }
                                            if ($move[0] - $move[2] == -3) {
                                                changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " 7050");
                                            }
                                        }




                                        if ($board[$move[0]][$move[1]] instanceof Pawn && ($move[3] == 0 || $move[3] == 7)) {
                                            changeParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice", "t" . $move[2] . $move[3] . "1");
                                        } else {
                                            changeParam("games/" . $_GET["gameRoom"], "currentmove", "player2");
                                        }
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
                                    }
                                }
                            }
                        }
                    }

                    changeParam("games/" . $_GET["gameRoom"], "chosenPiece1", null);
                    changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                } else {

                    if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "white") {
                        if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]] != null) {
                            changeParam("games/" . $_GET["gameRoom"], "chosenPiece1", $_GET["tresc"]);
                            changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                           
                        }
                    }
                }
            }
        }
        if (getParam("games/" . $_GET["gameRoom"], "player2") == $_SESSION["user"]) {

            if (getParam("games/" . $_GET["gameRoom"], "chosenPiece2") != null) {
                if (getParam("games/" . $_GET["gameRoom"], "currentmove") == "player2") {
                    if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "white" || $board[$_GET["tresc"][0]][$_GET["tresc"][1]] == null) {
                        $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1], $board);
                        foreach ($avaibleMoves as $value) {
                            if ($value[0] . $value[1] == $_GET["tresc"]) {
                                $move = getParam("games/" . $_GET["gameRoom"], "chosenPiece2") . $_GET["tresc"];
                                if (isMoveLegal("black", $move)) {
                                    changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " " . getParam("games/" . $_GET["gameRoom"], "chosenPiece2") . $_GET["tresc"]);
                                    if ($board[$move[0]][$move[1]] instanceof King) {
                                        if ($move[0] - $move[2] == 2) {
                                            changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " 0727");
                                        }
                                        if ($move[0] - $move[2] == -3) {
                                            changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " 7757");
                                        }
                                    }

                                    if ($board[$move[0]][$move[1]] instanceof Pawn && ($move[3] == 0 || $move[3] == 7)) {
                                        changeParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice", "t" . $move[2] . $move[3] . "2");
                                    } else {
                                        changeParam("games/" . $_GET["gameRoom"], "currentmove", "player1");
                                    }
                                    changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
                                }
                            }
                        }
                    }
                }

                changeParam("games/" . $_GET["gameRoom"], "chosenPiece2", null);
           
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
            } else {

                if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]]->color == "black") {
                    if ($board[$_GET["tresc"][0]][$_GET["tresc"][1]] != null) {
                        changeParam("games/" . $_GET["gameRoom"], "chosenPiece2", $_GET["tresc"]);
               
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
                    }
                }
            }
        }


        if (!isAnyMovePossible("white")) {
            if (getKing("white")[2]->isChecked(getKing("white")[0], getKing("white")[1], getBoard())) {
                changeParam("games/" . $_GET["gameRoom"], "gameState", "finished");
                changeParam("games/" . $_GET["gameRoom"], "winner", "black");
            } else {
                changeParam("games/" . $_GET["gameRoom"], "gameState", "finished");
                changeParam("games/" . $_GET["gameRoom"], "winner", "draw");
            }
            changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
        }
        if (!isAnyMovePossible("black")) {
            if (getKing("black")[2]->isChecked(getKing("black")[0], getKing("black")[1], getBoard())) {
                changeParam("games/" . $_GET["gameRoom"], "gameState", "finished");
                changeParam("games/" . $_GET["gameRoom"], "winner", "white");
            } else {
                changeParam("games/" . $_GET["gameRoom"], "gameState", "finished");
                changeParam("games/" . $_GET["gameRoom"], "winner", "draw");
            }
            changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
        }
    } else {
        if (isset($_GET["choice"])) {


            changeParam("games/" . $_GET["gameRoom"], "board", getParam("games/" . $_GET["gameRoom"], "board") . " " . $_GET["choice"] . getParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice")[1] . getParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice")[2]);
            if (getParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice")[3] == "1") {
                changeParam("games/" . $_GET["gameRoom"], "currentmove", "player2");
                changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
            } else {
                changeParam("games/" . $_GET["gameRoom"], "currentmove", "player1");
                changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
                                        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
            }
            changeParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice", "false");
        }
    }
}
if ($_GET["mode"] == "forceBoard") {
    if($_SESSION["user"]==getParam("games/" . $_GET["gameRoom"], "player1")){
        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","true");
    }
    if($_SESSION["user"]==getParam("games/" . $_GET["gameRoom"], "player2")){
        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","true");
    }
}
if ($_GET["mode"] == "getBoard") {
    echo (getParam("games/" . $_GET["gameRoom"], "board"));
}
if ($_GET["mode"] == "get") {

    if(($_SESSION["user"]==getParam("games/" . $_GET["gameRoom"], "player1")&&getParam("games/" . $_GET["gameRoom"], "worthToUpdate1")=="true")||($_SESSION["user"]==getParam("games/" . $_GET["gameRoom"], "player2")&&getParam("games/" . $_GET["gameRoom"], "worthToUpdate2")=="true")){
        if(($_SESSION["user"]==getParam("games/" . $_GET["gameRoom"], "player1"))){
        changeParam("games/" . $_GET["gameRoom"], "worthToUpdate1","false");
        }else{
            changeParam("games/" . $_GET["gameRoom"], "worthToUpdate2","false");
        }
       
    if (getParam("games/" . $_GET["gameRoom"], "gameState") == "ongoing") {

        echo generateBoard();
        if ((getParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice")[3] == "1" && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player1")) || (getParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice")[3] == "2" && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player2"))) {
            if (getParam("games/" . $_GET["gameRoom"], "isWaitingForPieceChoice") != "false") {
                echo "<span class='pieceChoice'><div style=background-image:url('images/whiteRook.png')></div><div style=background-image:url('images/whiteBishop.png')></div><div style=background-image:url('images/whiteKnight.png')></div><div style=background-image:url('images/whiteQueen.png')></div></span>";
              
            }
        }
    }
}
    if (getParam("games/" . $_GET["gameRoom"], "gameState") == "preparation") {
        echo "Oczekiwanie na drugiego gracza";
    }
    if (getParam("games/" . $_GET["gameRoom"], "gameState") == "finished") {
        echo "Gra się zakończyła";
        if (getParam("games/" . $_GET["gameRoom"], "winner") == "draw") {
            echo " remisem";
        } else {
            echo ". Wygrał " . getParam("games/" . $_GET["gameRoom"], "winner");
        }
    }
}
if ($_GET["mode"] == "getKey") {
    echo $_GET["gameRoom"];
}
function getKing($color)
{
    $result = [null, null, null];
    $board = getBoard();
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            if ($board[$i][$j] instanceof King) {
                if ($board[$i][$j]->color == $color) {
                    $result[0] = $i;
                    $result[1] = $j;
                    $result[2] = $board[$i][$j];
                    return $result;
                }
            }
        }
    }

    return null;
}
function isMoveLegal($color, $move)
{
    $king = getKing($color);
    $board = getBoard();

    if ($board[$move[0]][$move[1]] instanceof King) {
        $king[0] = $move[2];
        $king[1] = $move[3];
    }


    if (!$king[2]->isChecked($king[0], $king[1], makeMoves(getBoard(), [$move]))) {
        return true;
    }
    return false;
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


    $board = makeMoves($board, getMovesArray());



    return $board;
}
function makeMoves($board, $moves)
{

    if ($moves != null) {
        foreach ($moves as $value) {
            if (is_numeric($value[0])) {
                $board[$value[2]][$value[3]] = $board[$value[0]][$value[1]];
                $board[$value[0]][$value[1]] = null;
            } else {
                $color = $board[$value[1]][$value[2]]->color;
                switch ($value[0]) {
                    case "Q":
                        $board[$value[1]][$value[2]] = new Queen($color);
                        break;
                    case "B":
                        $board[$value[1]][$value[2]] = new Bishop($color);
                        break;
                    case "K":

                        $board[$value[1]][$value[2]] = new Knight($color);
                        break;
                    case "R":
                        $board[$value[1]][$value[2]] = new Rook($color);
                        break;
                }
            }
        }
    }

    return $board;
}
function havePieceMoved($positionX, $positionY)
{
    $moves = getMovesArray();
    if ($moves != null) {
        foreach ($moves as $value) {
            if (is_numeric($value[0])) {
                if ($value[0] . $value[1] == $positionX . $positionY) {
                    return true;
                }
                if ($value[2] . $value[3] == $positionX . $positionY) {
                    return true;
                }
            }
        }
    }
    return false;
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
            if (isMovePossible("white", $i, $j, $board)) {
                $specialClass = "mozliwy";
            }

            if (isMovePossible("black", $i, $j, $board)) {
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

function isMovePossible($color, $posX, $posY, $board)
{
    if ($color == "black") {
        if (getParam("games/" . $_GET["gameRoom"], "chosenPiece2") != null && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player2")) {
            $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1], $board);
            foreach ($avaibleMoves as $value) {
                if ($value[0] . $value[1] == $posX . $posY) {

                    if (isMoveLegal($color, getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[0] . getParam("games/" . $_GET["gameRoom"], "chosenPiece2")[1] . $posX . $posY)) {
                        return true;
                    }
                }
            }
        }
    }
    if ($color == "white") {
        if (getParam("games/" . $_GET["gameRoom"], "chosenPiece1") != null && $_SESSION["user"] == getParam("games/" . $_GET["gameRoom"], "player1")) {
            $avaibleMoves = $board[getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0]][getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1]]->getAvaibleMoves(getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0], getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1], $board);
            foreach ($avaibleMoves as $value) {

                if ($value[0] . $value[1] == $posX . $posY) {


                    if (isMoveLegal($color, getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[0] . getParam("games/" . $_GET["gameRoom"], "chosenPiece1")[1] . $posX . $posY)) {
                        return true;
                    }
                }
            }
        }
    }
    return false;
}

function isAnyMovePossible($color)
{
    $board = getBoard();
    for ($i = 0; $i < 8; $i++) {
        for ($j = 0; $j < 8; $j++) {
            if ($board[$i][$j] != null) {
                if ($board[$i][$j]->color == $color) {
                    $avaibleMoves = $board[$i][$j]->getAvaibleMoves($i, $j, $board);
                    foreach ($avaibleMoves as $value) {
                        if (isMoveLegal($color, $i . $j . $value[0] . $value[1])) {
                            return true;
                        }
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
function removeIllegalMoves($color, $positionX, $positionY, $moves)
{
    $legalMoves = [];
    foreach ($moves as $value) {
        if (isMoveLegal($color, $positionX . $positionY . $positionX . $positionY + 1)) {
            array_push($legalMoves, $value);
        }
    }
    return $legalMoves;
}
