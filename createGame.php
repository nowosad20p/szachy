<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nie pacz tu bo nie ładnie</title>
</head>

<body>
    <?php

    $fileName = "";
    for ($i = 0; $i < 5; $i++) {
        $fileName = $fileName . chr(rand(65, 90));
    }
    $file = fopen("games/" . $fileName, "c");
    fopen("chats/" . $fileName."-chat", "c");
    
    if(!isset($_GET["isGamePrivate"])){
        fwrite($file, "player1:\nplayer2:\nboard:\ncurrentmove:player1\nchosenPiece1:\nchosenPiece2:\ngameState:preparation\nworthToUpdate1:true\nworthToUpdate2:true\nwinner:\nroomStatus:public");
    }else{
        fwrite($file, "player1:\nplayer2:\nboard:\ncurrentmove:player1\nchosenPiece1:\nchosenPiece2:\ngameState:preparation\nworthToUpdate1:true\nworthToUpdate2:true\nwinner:\nroomStatus:private");
    }
    header("Location:game.php?gameRoom=" . $fileName);
    ?>
</body>

</html>