<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gra</title>
    <link rel="stylesheet" href="style/style.css">
</head>


<body>
    <?php
    require_once("nav.php");
    ?>
    <main>
        <div id="game">
    <h2 id="kod"></h2>
    <div class="board"></div>
    </div>
   
    <div id="czatContainer">
    <div id="czat"></div>
    <input type="text" id="tresc">
    <button id="czatBtn">Wyślij</button> 
    </div>
    </main>
    <script>
        document.querySelector("#czatBtn").addEventListener("click",sendMessage);

        getRoomName();
        function getChat(){
            let request=new XMLHttpRequest();
            request.open("GET","chat.php?"+(window.location.href).split("?")[1]+"&mode=get",true);
            request.onload=()=>{
                if (request.readyState == XMLHttpRequest.DONE) {

                if (request.status === 200) {
                    data=request.response;
                    document.querySelector("#czat").innerHTML=data;
                }

            }
            

        }
        request.send();
    }
    function sendMessage(){
        tresc=document.querySelector("#tresc").value;
        let request=new XMLHttpRequest();
        request.open("GET","chat.php?"+(window.location.href).split("?")[1]+"&mode=update"+"&tresc="+tresc,true);
        request.send();
        
        getChat();
       
    }
        function getRoomName(){
            let request=new XMLHttpRequest();
            request.open("GET","board.php?"+(window.location.href).split("?")[1]+"&mode=getKey",true);
            request.onload=()=>{
                if (request.readyState == XMLHttpRequest.DONE) {

                if (request.status === 200) {
                    data=request.response;
                    document.querySelector("#kod").innerHTML=data;
                }

            }

        }
        request.send();
        document.querySelector("#kod").onclick=navigator.clipboard.writeText(window.location.href);
        }
        function updateBoard() {

            let xhr = new XMLHttpRequest();

            xhr.open("GET", "board.php?mode=update&tresc=" + this.id + "&" + (window.location.href).split("?")[1], true);



            xhr.send();

            getBoard();
        }
        getBoard();


        let board;

        function setBoard() {
            let xhr = new XMLHttpRequest();

            xhr.open("POST", "board.php?mode=get&" + (window.location.href).split("?")[1], true);

            xhr.onload = () => {
                if (xhr.readyState == XMLHttpRequest.DONE) {

                    if (xhr.status === 200) {
                        let data = xhr.response;

                        document.querySelector(".board").innerHTML = data;
                        pola = document.querySelectorAll(".board>div");
                        for (i = 0; i < pola.length; i++) {
                            pola[i].addEventListener("click", updateBoard, false)

                        }

                    }
                }
            }

            xhr.send();
        }

        function getBoard() {

            let xhrr = new XMLHttpRequest();

            xhrr.open("POST", "board.php?mode=getBoard&" + (window.location.href).split("?")[1], true);

            xhrr.onload = () => {
                if (xhrr.readyState == XMLHttpRequest.DONE) {

                    if (xhrr.status === 200) {
                        let data = xhrr.response;
                        if (data != null) {
                            board = data
                            setBoard()
                        }
                        setBoard()
                    }

                }
            }
            xhrr.send();
        }
        setInterval(getBoard, 10000)
        //setInterval(getChat, 1000)
    </script>

    <?php
    ob_start();
    session_start();
    require_once("functions.php");

    $player1 = getParam("games/" . $_GET["gameRoom"], "player1");
    $player2 = getParam("games/" . $_GET["gameRoom"], "player2");


    if (is_null($player1) || trim($player1) == $_SESSION["user"]) {


        changeParam("games/" . $_GET["gameRoom"], "player1", $_SESSION["user"]);
    } else {
        if (is_null($player2) || trim($player2) == $_SESSION["user"]) {
            changeParam("games/" . $_GET["gameRoom"], "player2", $_SESSION["user"]);
            changeParam("games/" . $_GET["gameRoom"], "gameState", "ongoing");
        } else {

           
            header("Location:index.php?error=fullRoom");
        }
    }



    ?>
</body>

</html>