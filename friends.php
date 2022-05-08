<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Znajomi</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/friendsStyle.css">
</head>
<body>
    <?php
    include("nav.php");
    include("friendsManager.php");
   

    ?>
    <main>
    <div class="addFriendSearchBar">Dodaj znajomego:<input type="text" id="name"><ul></ul></div>
    <div class="friendsList">Lista znajomych:<ul></ul></div>
    <div class="friendInvites">Twoje zaproszenia do znajomych:<ul></ul></div>
    <div class="gameInvites">Twoje zaproszenia do gry:<ul></ul></div>
    </main>
    <script>
        let searchBar=document.querySelector(".addFriendSearchBar>input");
        let interval;
        searchBar.addEventListener("focus",()=>{updatePlayerHint();interval=setInterval(updatePlayerHint,1000)});
        searchBar.addEventListener("focusout",()=>{document.querySelector(".addFriendSearchBar>ul").innerHTML="";clearInterval(interval)});
        function updatePlayerHint(){
            let request=new XMLHttpRequest();
            request.open("GET","getPlayerNameHint.php?cur="+document.getElementById("name").value,true);
            request.onload=()=>{
                document.querySelector(".addFriendSearchBar>ul").innerHTML=request.response;
               

                
               
            }
            request.send();
        }

    </script>
</body>
</html>