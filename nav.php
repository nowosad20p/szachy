
<link rel="stylesheet" href="style/navStyle.css">
<nav>
    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="gameForm.php">Graj</a></li>
        <li><a>Kontakt</a></li>
        <li>
                <?php

                ob_start();
                session_start();
                if (!isset($_SESSION["user"])) {
                    echo "<a href='login.php'>Zaloguj się</a>";
                } else {
                    echo "<label for='accountMenu'>".$_SESSION["user"]."</div><input type='checkbox' id='accountMenu'>";
                    echo "<ul class='hiddenMenu'>
                    <li><a href='accountinfo.php?user=".$_SESSION["user"]."'>Twoje konto</a></li>
                    <li><a href='friends.php'>Znajomi</a></li>
                    <li><a href='signout.php'>Wyloguj</a></li>
                    </ul>";
                }
               
                ?>
          
        </li>
    </ul>
</nav>