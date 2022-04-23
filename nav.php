
<link rel="stylesheet" href="style/navStyle.css">
<nav>
    <ul>
        <li><a href="index.php">Strona główna</a></li>
        <li><a href="gameForm.php">Graj</a></li>
        <li><a>Kontakt</a></li>
        <li><a href="login.php">
                <?php

                ob_start();
                session_start();
                if (!isset($_SESSION["user"])) {
                    echo "Zaloguj się";
                } else {
                    echo $_SESSION["user"];
                }

                ?>
            </a>
        </li>
    </ul>
</nav>