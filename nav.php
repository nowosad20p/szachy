<link rel="stylesheet" href="style/navStyle.css">
<nav>
   <ul>
    <li>Strona główna</li>
    <li><a href="gameForm.php">Graj</a></li>
    <li>Kontakt</li>
    <li>
    <?php

    ob_start();
  
    if(!isset($_SESSION["user"])){
        echo"Zaloguj się";
    }else{
        echo "Konto";
    }
    
    ?>
   </li>
    </ul>
</nav>