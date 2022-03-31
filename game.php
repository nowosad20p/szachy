<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p id="plansza">aeeeeee</p>
    <input type="text" id="tresc">
    <p id="poka"></p>
    <button id="dzialajPlz">Wyślij</button>
    <script>
        
        let a=document.querySelector("#dzialajPlz");
            a.addEventListener("click",updateTxtFile);
        
        function updateTxtFile(){
            tresc=document.querySelector("#tresc").value;
            let xhr=new XMLHttpRequest();

             xhr.open("GET","plansza.php?mode=update&tresc="+tresc+"&"+(window.location.href).split("?")[1],true);
  
            
           
        
        xhr.send();
        }
        getBoard();

  
        function getBoard(){
           
        let xhr=new XMLHttpRequest();

         xhr.open("POST","plansza.php?mode=get&"+(window.location.href).split("?")[1],true);
  
         xhr.onload=()=>{
         if(xhr.readyState==XMLHttpRequest.DONE){
             
             if(xhr.status===200){
                 let data=xhr.response;
                 if(data!=document.querySelector("#plansza").innerHTML){
                 document.querySelector("#plansza").innerHTML=data;
                 }
             }
         }
        }
        xhr.send();
    }
  
      
        setInterval(getBoard,100);
</script>
<?php
ob_start();
session_start();
require_once("functions.php");
$game=fopen("games/".$_GET["gameRoom"],"r+");
$player1 =getParam("games/".$_GET["gameRoom"],"player1");
$player2=getParam("games/".$_GET["gameRoom"],"player2");
// while($line=fgets($game)){
//     if(explode(":",$line)[0]=="player1"){
//         $player1 = explode(":",$line)[1];
//     }
//     if(explode(":",$line)[0]=="player2"){
//         $player2 = explode(":",$line)[1];
//     }
// }

fclose($game);

if(is_null($player1)||trim($player1)==$_SESSION["user"]){
    
  
        changeParam("games/".$_GET["gameRoom"],"player1",$_SESSION["user"]);
    
}else{
    if(is_null($player2)||trim($player2)==$_SESSION["user"]){
        changeParam("games/".$_GET["gameRoom"],"player2",$_SESSION["user"]);
    }else{

        echo $player1." ".$player2;
        header("Location:index.php?error=fullRoom");
    }
}



?>
</body>
</html>