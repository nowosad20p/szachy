<?php
abstract class ChessPiece{
    protected $positionX;
    protected $positionY;
    public $color;
    
    function __construct($positionX,$positionY,$color)
    {
        $this->positionX=$positionX;
        $this->positionY=$positionY;
        $this->color=$color;
    }
}
class Pawn extends ChessPiece{
    private $direction;
    function __construct($positionX,$positionY,$color)
    {
        $this->positionX=$positionX;
        $this->positionY=$positionY;
        $this->color=$color;
        if($this->color=="white"){
            $this->direction=1;
        }
        if($this->color=="black"){
            $this->direction=-1;
        }
    }
    public function getAvaibleMoves($board){
        $avaibleMoves=[];
       
            if($board[$this->positionX][$this->positionY+$this->direction]==null&&$this->positionY+$this->direction<8&&$this->positionY+$this->direction>=0){
                array_push($avaibleMoves,[$this->positionX,$this->positionY+1]);             
            }
            if($this->positionY==1){
                if($board[$this->positionX][$this->positionY+2*$this->direction]==null&&$this->positionY+2*$this->direction>0&&$this->positionY+2*$this->direction<8){
                    array_push($avaibleMoves,[$this->positionX,$this->positionY+2]);             
                }
            }
            if($board[$this->positionX+1][$this->positionY+$this->direction]!=null){
                if($board[$this->positionX+1][$this->positionY+$this->direction]->color!=$this->color){
                    array_push($avaibleMoves,[$this->positionX+1,$this->positionY+$this->direction]);         
                    }      
            }
            if($board[$this->positionX-1][$this->positionY+$this->direction]!=null){
                if($board[$this->positionX-1][$this->positionY+$this->direction]->color!=$this->color){
                array_push($avaibleMoves,[$this->positionX-1,$this->positionY+$this->direction]);         
                }
            }

        return $avaibleMoves;
    }
}
class Knight extends ChessPiece{

}
class Bishop extends ChessPiece{

}
class Rook extends ChessPiece{

}
class Queen extends ChessPiece{

}
class King extends ChessPiece{

}