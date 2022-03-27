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


        function getBoard(){
     let xhr=new XMLHttpRequest();
     xhr.open("POST","plansza.php",true);
    
     xhr.onload=()=>{
         if(xhr.readyState==XMLHttpRequest.DONE){
             if(xhr.status===200){
                 let data=xhr.response;
                 document.querySelector("#plansza").innerHTML=data;
             }else{
               
             }
         }else{
           
         }
        
     }
     xhr.send();
   

       
       
       
    }

   getBoard()
       
</script>
</body>
</html>
