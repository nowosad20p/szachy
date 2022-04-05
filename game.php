<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <p id="plansza">aeeeeee</p>
    <input type="text" id="tresc">
    <p id="poka"></p>
    <button id="dzialajPlz">Wyślij</button>
    <script>
        let active=null;
       
        
        function updateBoard(tresc) {
            
            let xhr = new XMLHttpRequest();

            xhr.open("GET", "board.php?mode=update&tresc=" + tresc + "&" + (window.location.href).split("?")[1], true);
           


            xhr.send();
        }
        getBoard();

        function divClick(){
            if(active==null){
                active=this;
               this.classList+=" aktywny";
               console.log(this);
                
            }else{
                if(active.id!=this.id){
                updateBoard(active.id+this.id);
                
                active=null;

                }else{
                   
                   active.classList.remove("aktywny")
                console.log(active.classList);
                active=null;
                }

            }
        }
        let board;
        function getBoard() {
            
            let xhrr = new XMLHttpRequest();

            xhrr.open("POST", "board.php?mode=getBoard&" + (window.location.href).split("?")[1], true);

            xhrr.onload = () => {
                if (xhrr.readyState == XMLHttpRequest.DONE) {

                    if (xhrr.status === 200) {
                        let data = xhrr.response;
                        if (data != board) {
                            board=data
                            let xhr = new XMLHttpRequest();

                              xhr.open("POST", "board.php?mode=get&" + (window.location.href).split("?")[1], true);

                                 xhr.onload = () => {
                                                      if (xhr.readyState == XMLHttpRequest.DONE) {

                                    if (xhr.status === 200) {
                                             let data = xhr.response;
                                                 if (data != document.querySelector("#plansza").innerHTML) {
                                              document.querySelector("#plansza").innerHTML = data;
                                     pola=document.querySelectorAll(".board>div");
                                        for(i=0;i<pola.length;i++){
                                        pola[i].addEventListener("click",divClick,false)
                                
                            }
                        }
                    }
                }
            }
           
            xhr.send();
        }
                        }
                    }
                }
                xhrr.send();
            }
            

  
            


        setInterval(getBoard, 100);
    </script>
    <?php
    ob_start();
    session_start();
    require_once("functions.php");
    $game = fopen("games/" . $_GET["gameRoom"], "r+");
    $player1 = getParam("games/" . $_GET["gameRoom"], "player1");
    $player2 = getParam("games/" . $_GET["gameRoom"], "player2");
 

    fclose($game);

    if (is_null($player1) || trim($player1) == $_SESSION["user"]) {


        changeParam("games/" . $_GET["gameRoom"], "player1", $_SESSION["user"]);
    } else {
        if (is_null($player2) || trim($player2) == $_SESSION["user"]) {
            changeParam("games/" . $_GET["gameRoom"], "player2", $_SESSION["user"]);
        } else {

            echo $player1 . " " . $player2;
            header("Location:index.php?error=fullRoom");
        }
    }



    ?>
</body>

</html>