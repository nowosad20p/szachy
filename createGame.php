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
    fopen("chats/" . $fileName . "-chat", "c");

    if (!isset($_GET["isGamePrivate"])) {
        fwrite($file, "player1:\nplayer2:\nboard:\ncurrentmove:player1\nchosenPiece1:\nchosenPiece2:\ngameState:preparation\nworthToUpdate1:true\nworthToUpdate2:true\nisWaitingForPieceChoice:false\nwinner:\nroomStatus:public\npunishment:");
    } else {
        fwrite($file, "player1:\nplayer2:\nboard:\ncurrentmove:player1\nchosenPiece1:\nchosenPiece2:\ngameState:preparation\nworthToUpdate1:true\nworthToUpdate2:true\nisWaitingForPieceChoice:false\nwinner:\nroomStatus:private\npunishment:");
    }
    if ($_GET["friendListChk"] == "on") {
        file_put_contents("users/" . $_GET["friendSelect"] . "/gameInvites.txt", $fileName . "\n", FILE_APPEND);
    }
    header("Location:game.php?gameRoom=" . $fileName);
    ?>
</body>

</html>