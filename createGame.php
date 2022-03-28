<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    $fileName="";
    for($i=0;$i<6;$i++){
        $fileName=$fileName.chr(rand(65,90));
    }
    $file=fopen("games/".$fileName,"c");
    header("Location:game.php?gameRoom=".$fileName);
    ?>
</body>
</html>