<?php

abstract class ChessPiece
{

    public $color;

    function __construct($color)
    {

        $this->color = $color;
    }
}
class Pawn extends ChessPiece
{
    private $direction;
    function __construct($color)
    {

        $this->color = $color;
        if ($this->color == "white") {
            $this->direction = 1;
        }
        if ($this->color == "black") {
            $this->direction = -1;
        }
    }
    public function getAvaibleMoves($positionX, $positionY, $board)
    {
        $avaibleMoves = [];

        if ($board[$positionX][$positionY + $this->direction] == null && $positionY + $this->direction < 8 && $positionY + $this->direction >= 0) {
            array_push($avaibleMoves, [$positionX, $positionY + $this->direction]);
        }
        if (($positionY == 1 && $this->color == "white") || ($positionY == 6 && $this->color == "black")) {
            if ($board[$positionX][$positionY + 2 * $this->direction] == null && $positionY + 2 * $this->direction > 0 && $positionY + 2 * $this->direction < 8) {
                array_push($avaibleMoves, [$positionX, $positionY + 2 * $this->direction]);
            }
        }
        if ($positionX + 1 < 8) {
            if ($board[$positionX + 1][$positionY + $this->direction] != null) {
                if ($board[$positionX + 1][$positionY + $this->direction]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 1, $positionY + $this->direction]);
                }
            }
        }
        if ($positionX - 1 >= 0) {
            if ($board[$positionX - 1][$positionY + $this->direction] != null) {
                if ($board[$positionX - 1][$positionY + $this->direction]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 1, $positionY + $this->direction]);
                }
            }
        }
      if(getLastMove()!=null){
          if($board[getLastMove()[2]][getLastMove()[3]]instanceof Pawn){
            if($board[getLastMove()[2]][getLastMove()[3]]->color!=$this->color){
                if(($positionY==3&&$this->color=="black")||($positionY==4&&$this->color=="white")){
                    array_push($avaibleMoves,getLastMove()[2].getLastMove()[3]+$this->direction);
                }
               
            }
          }
      }
        return $avaibleMoves;
    }
}
class Knight extends ChessPiece
{
    public function getAvaibleMoves($positionX, $positionY, $board)
    {
        $avaibleMoves = [];
        if ($positionY + 2 < 8 && $positionX + 1 < 8) {
            if ($board[$positionX + 1][$positionY + 2] != null) {
                if ($board[$positionX + 1][$positionY + 2]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 1, $positionY + 2]);
                }
            } else {
                array_push($avaibleMoves, [$positionX + 1, $positionY + 2]);
            }
        }
        if ($positionY + 2 < 8 && $positionX - 1 >= 0) {
            if ($board[$positionX - 1][$positionY + 2] != null) {
                if ($board[$positionX - 1][$positionY + 2]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 1, $positionY + 2]);
                }
            } else {
                array_push($avaibleMoves, [$positionX - 1, $positionY + 2]);
            }
        }

        if ($positionY - 2 >= 0 && $positionX + 1 < 8) {
            if ($board[$positionX + 1][$positionY - 2] != null) {
                if ($board[$positionX + 1][$positionY - 2]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 1, $positionY - 2]);
                }
            } else {
                array_push($avaibleMoves, [$positionX + 1, $positionY - 2]);
            }
        }
        if ($positionY - 2 >= 0 && $positionX - 1 >= 0) {
            if ($board[$positionX - 1][$positionY - 2] != null) {
                if ($board[$positionX - 1][$positionY - 2]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 1, $positionY - 2]);
                }
            } else {
                array_push($avaibleMoves, [$positionX - 1, $positionY - 2]);
            }
        }

        if ($positionY - 1 >= 0 && $positionX + 2 < 8) {
            if ($board[$positionX + 2][$positionY - 1] != null) {
                if ($board[$positionX + 2][$positionY - 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 2, $positionY - 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX + 2, $positionY - 1]);
            }
        }
        if ($positionY + 1 < 8 && $positionX + 2 < 8) {
            if ($board[$positionX + 2][$positionY + 1] != null) {
                if ($board[$positionX + 2][$positionY + 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 2, $positionY + 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX + 2, $positionY + 1]);
            }
        }

        if ($positionY - 1 >= 0 && $positionX - 2 >= 0) {
            if ($board[$positionX - 2][$positionY - 1] != null) {
                if ($board[$positionX - 2][$positionY - 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 2, $positionY - 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX - 2, $positionY - 1]);
            }
        }
        if ($positionY + 1 < 8 && $positionX - 2 >= 0) {
            if ($board[$positionX - 2][$positionY + 1] != null) {
                if ($board[$positionX - 2][$positionY + 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 2, $positionY + 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX - 2, $positionY + 1]);
            }
        }
        return $avaibleMoves;
    }
}
class Bishop extends ChessPiece
{
    public function getAvaibleMoves($positionX, $positionY, $board)
    {
        $avaibleMoves = [];
        $temp = null;
        $x = $positionX + 1;
        $y = $positionY + 1;
        while ($temp == null && $x < 8 && $y < 8) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x++;
            $y++;
        }
        $temp = null;
        $x = $positionX + 1;
        $y = $positionY - 1;
        while ($temp == null && $x < 8 && $y >= 0) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x++;
            $y--;
        }
        $temp = null;
        $x = $positionX - 1;
        $y = $positionY - 1;
        while ($temp == null && $x >= 0 && $y >= 0) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x--;
            $y--;
        }
        $temp = null;
        $x = $positionX - 1;
        $y = $positionY + 1;
        while ($temp == null && $x >= 0 && $y < 8) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x--;
            $y++;
        }
        return $avaibleMoves;
    }
}
class Rook extends ChessPiece
{
    public function getAvaibleMoves($positionX, $positionY, $board)
    {
        $avaibleMoves = [];
        $temp = null;
        $x = $positionX + 1;
        while ($temp == null && $x < 8) {
            $temp = $board[$x][$positionY];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $positionY]);
            } else {
                array_push($avaibleMoves, [$x, $positionY]);
            }
            $x++;
        }
        $temp = null;
        $x = $positionX - 1;
        while ($temp == null && $x >= 0) {
            $temp = $board[$x][$positionY];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $positionY]);
            } else {
                array_push($avaibleMoves, [$x, $positionY]);
            }
            $x--;
        }

        $temp = null;
        $y = $positionY - 1;
        while ($temp == null && $y >= 0) {
            $temp = $board[$positionX][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$positionX, $y]);
            } else {
                array_push($avaibleMoves, [$positionX, $y]);
            }
            $y--;
        }
        $temp = null;
        $y = $positionY + 1;
        while ($temp == null && $y < 8) {
            $temp = $board[$positionX][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$positionX, $y]);
            } else {
                array_push($avaibleMoves, [$positionX, $y]);
            }
            $y++;
        }
        return $avaibleMoves;
    }
}
class Queen extends ChessPiece
{
    public function getAvaibleMoves($positionX, $positionY, $board)
    {
        $avaibleMoves = [];
        $temp = null;
        $x = $positionX + 1;
        while ($temp == null && $x < 8) {
            $temp = $board[$x][$positionY];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $positionY]);
            } else {
                array_push($avaibleMoves, [$x, $positionY]);
            }
            $x++;
        }
        $temp = null;
        $x = $positionX - 1;
        while ($temp == null && $x >= 0) {
            $temp = $board[$x][$positionY];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $positionY]);
            } else {
                array_push($avaibleMoves, [$x, $positionY]);
            }
            $x--;
        }

        $temp = null;
        $y = $positionY - 1;
        while ($temp == null && $y >= 0) {
            $temp = $board[$positionX][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$positionX, $y]);
            } else {
                array_push($avaibleMoves, [$positionX, $y]);
            }
            $y--;
        }
        $temp = null;
        $y = $positionY + 1;
        while ($temp == null && $y < 8) {
            $temp = $board[$positionX][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$positionX, $y]);
            } else {
                array_push($avaibleMoves, [$positionX, $y]);
            }
            $y++;
        }
        $temp = null;
        $x = $positionX + 1;
        $y = $positionY + 1;
        while ($temp == null && $x < 8 && $y < 8) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x++;
            $y++;
        }
        $temp = null;
        $x = $positionX + 1;
        $y = $positionY - 1;
        while ($temp == null && $x < 8 && $y >= 0) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x++;
            $y--;
        }
        $temp = null;
        $x = $positionX - 1;
        $y = $positionY - 1;
        while ($temp == null && $x >= 0 && $y >= 0) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x--;
            $y--;
        }
        $temp = null;
        $x = $positionX - 1;
        $y = $positionY + 1;
        while ($temp == null && $x >= 0 && $y < 8) {
            $temp = $board[$x][$y];
            if ($temp != null) {
                if ($temp->color != $this->color)
                    array_push($avaibleMoves, [$x, $y]);
            } else {
                array_push($avaibleMoves, [$x, $y]);
            }
            $x--;
            $y++;
        }
        return $avaibleMoves;
    }
}

class King extends ChessPiece
{
    public function getAvaibleMoves($positionX, $positionY, $board)
    {
        $avaibleMoves = [];
        if ($positionY + 1 < 8) {
            if ($board[$positionX][$positionY + 1] != null) {
                if ($board[$positionX][$positionY + 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX, $positionY + 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX, $positionY + 1]);
            }
        }
        if ($positionY - 1 >= 0) {
            if ($board[$positionX][$positionY - 1] != null) {
                if ($board[$positionX][$positionY - 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX, $positionY - 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX, $positionY - 1]);
            }
        }
        if ($positionX - 1 >= 0) {
            if ($board[$positionX - 1][$positionY] != null) {
                if ($board[$positionX - 1][$positionY]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 1, $positionY]);
                }
            } else {
                array_push($avaibleMoves, [$positionX - 1, $positionY]);
            }
        }
        if ($positionX + 1 < 8) {
            if ($board[$positionX + 1][$positionY] != null) {
                if ($board[$positionX + 1][$positionY]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 1, $positionY]);
                }
            } else {
                array_push($avaibleMoves, [$positionX + 1, $positionY]);
            }
        }
        if ($positionX + 1 < 8 && $positionY + 1 < 8) {
            if ($board[$positionX + 1][$positionY + 1] != null) {
                if ($board[$positionX + 1][$positionY + 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 1, $positionY + 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX + 1, $positionY + 1]);
            }
        }
        if ($positionX - 1 >= 0 && $positionY + 1 < 8) {
            if ($board[$positionX - 1][$positionY + 1] != null) {
                if ($board[$positionX - 1][$positionY + 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 1, $positionY + 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX - 1, $positionY + 1]);
            }
        }
        if ($positionX - 1 >= 0 && $positionY - 1 >= 0) {
            if ($board[$positionX - 1][$positionY - 1] != null) {
                if ($board[$positionX - 1][$positionY - 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX - 1, $positionY - 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX - 1, $positionY - 1]);
            }
        }
        if ($positionX + 1 < 8 && $positionY - 1 >= 0) {
            if ($board[$positionX + 1][$positionY - 1] != null) {
                if ($board[$positionX + 1][$positionY - 1]->color != $this->color) {
                    array_push($avaibleMoves, [$positionX + 1, $positionY - 1]);
                }
            } else {
                array_push($avaibleMoves, [$positionX + 1, $positionY - 1]);
            }
        }

        if ($this->color == "white") {
            if (!havePieceMoved(3, 0)) {
                $board = getBoard();
                if ($board[2][0] == null && $board[1][0] == null) {
                    if (!havePieceMoved(0, 0)) {
                        array_push($avaibleMoves, [1, 0]);
                    }
                }
                if ($board[4][0] == null && $board[5][0] == null && $board[6][0] == null) {
                    if (!havePieceMoved(7, 0)) {
                        array_push($avaibleMoves, [6, 0]);
                    }
                }
            }
        }
        if ($this->color == "black") {
            if (!havePieceMoved(3, 7)) {
                $board = getBoard();
                if ($board[2][7] == null && $board[1][7] == null) {
                    if (!havePieceMoved(0, 7)) {
                        array_push($avaibleMoves, [1, 7]);
                    }
                }
                if ($board[4][7] == null && $board[5][7] == null && $board[6][7] == null) {
                    if (!havePieceMoved(7, 7)) {
                        array_push($avaibleMoves, [6, 7]);
                    }
                }
            }
        }
        return $avaibleMoves;
    }
    public function isChecked($positionX, $positionY, $board)
    {



        for ($i = 0; $i < 8; $i++) {
            for ($j = 0; $j < 8; $j++) {
                if ($board[$j][$i] != null) {
                    if ($board[$j][$i]->color != $this->color) {
                        $avaibleMoves = $board[$j][$i]->getAvaibleMoves($j, $i, $board);
                        foreach ($avaibleMoves as $value) {
                            if ($value[0] . $value[1] == $positionX . $positionY) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }
}
