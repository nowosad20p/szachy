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
    <div class="friendsList">Lista znajomych:<ul>
        <?php
        $friends=fopen("users/".$_SESSION["user"]."/friendList.txt","r");
        while($value=fgets($friends)){
            echo "<li>".$value."</li>";
        }
        ?>
    </ul></div>
    <div class="friendInvites">Twoje zaproszenia do znajomych:<ul>
    <?php
        $invites=fopen("users/".$_SESSION["user"]."/friendRequests.txt","r");
        while($value=fgets($invites)){
            echo "<li><span>".$value."</span><input type='button' class='acceptBtn'><input class='rejectBtn' type='button'></li>";
        }
        ?>
        <script>
            acceptButtons=document.querySelectorAll(".acceptBtn");
           
            for(let i=0;i<acceptButtons.length;i++){
                acceptButtons[i].addEventListener("click",()=>{
                        console.log(acceptButtons[i].parentNode.querySelector("span").innerHTML);

                    },false)
                }
        </script>
    </ul></div>
    <div class="gameInvites">Twoje zaproszenia do gry:<ul>
    <?php
        $invites=fopen("users/".$_SESSION["user"]."/gameInvites.txt","r");
        while($value=fgets($invites)){
            echo "<li>".$value."</li>";
        }
        ?>
    </ul></div>
    </main>
    <script>
        let searchBar=document.querySelector(".addFriendSearchBar>input");
        let interval;
        searchBar.addEventListener("input",()=>{updatePlayerHint()});
 
       
        function updatePlayerHint(){
            let request=new XMLHttpRequest();
            request.open("GET","getPlayerNameHint.php?cur="+document.getElementById("name").value,true);
            request.onload=()=>{
                ae = document.querySelector(".addFriendSearchBar>ul")
                ae.innerHTML=request.response;
                buttons=ae.querySelectorAll("input[type=button]");
                for(let i=0;i<buttons.length;i++){
                    buttons[i].addEventListener("click",()=>{
                        sendFriendRequest(buttons[i].value);

                    },false)
                }
                
               
            }
            request.send();
        }
        function sendFriendRequest(ae){
            console.log(ae)
            let request=new XMLHttpRequest();
            request.open("GET","friendsManager.php?mode=sendFriendRequest&secondUser="+ae,true);
            request.send();
        }
        
        
    </script>
</body>
</html>