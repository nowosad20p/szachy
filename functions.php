<?php
function findUserId($login)
{
    $users = fopen("users.txt", "r");
    $licznik = 0;
    while ($line = fgets($users)) {

        if ($login == explode(" ", $line)[0]) {
            fclose($users);
            return $licznik;
        }
        $licznik++;
    }
    return null;
}
function findUserName()
{
    $users = fopen("users.txt", "r");
}
function changeParam($filePath, $paramName, $paramValue)
{
    $newFile = "";
    $file = fopen($filePath, "r+");
    while ($line = fgets($file)) {
        if (explode(":", $line)[0] == $paramName) {
            $line = $paramName . ":" . $paramValue . "\n";
        }
        $newFile = $newFile . $line;
    }


    fclose($file);
    $file = fopen($filePath, "w");

    fwrite($file, $newFile);
    fclose($file);
}
function removeLine($path,$value){
$file=fopen($path,"r+");

$newFile="";
while($a=fgets($file)){
if(trim($a)!=$value){
    $newFile=$newFile.$a;
}

}
echo $newFile;
file_put_contents($path,$newFile);
fclose($file);
}
function getParam($filePath, $paramName)
{
    $file = fopen($filePath, "r");
    while ($line = fgets($file)) {
        if (explode(":", $line)[0] == $paramName) {
            if (explode(":", $line)[1] != "\n") {
                return trim(explode(":", $line)[1]);
            } else {
                return null;
            }
        }
    }
    return null;
}
