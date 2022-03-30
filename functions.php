<?php
function findUserId($login){
    $users=fopen("users.txt","r");
    $licznik=0;
    while($line=fgets($users)){

        if($login==explode(" ",$line)[0]){
            fclose($users);
            return $licznik;
        }
        $licznik++;
        
     }
     return null;
}
function findUserName(){
    $users=fopen("users.txt","r");
    
}
function changeParam($filePath,$paramName,$paramValue){
    $newFile="";
    $file=fopen($filePath,"r+");
    while($line=fgets($file)){
        if(explode(":",$line)[0]==$paramName){
           $line=$paramName.":".$paramValue;
        }
        $newFile=$newFile.$line;

}
echo $newFile;
fclose($file);
$file=fopen($filePath,"w");

fwrite($file,$newFile);
fclose($file);
}