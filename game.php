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
    <script>
 getBoard();
document.write("plansza.php?"+(window.location.href).split("?")[1]);
  
        function getBoard(){
           
     let xhr=new XMLHttpRequest();

     xhr.open("POST","plansza.php?"+(window.location.href).split("?")[1],true);
  
     xhr.onload=()=>{
         if(xhr.readyState==XMLHttpRequest.DONE){
             
             if(xhr.status===200){
                 let data=xhr.response;
                 if(data!=document.querySelector("#plansza").innerHTML){
                 document.querySelector("#plansza").innerHTML=data;
                 }
             }else{
               
             }
         }else{
           
         }
        }
        xhr.send();
    }
  
      
        setInterval(getBoard,1);
</script>
</body>
</html>