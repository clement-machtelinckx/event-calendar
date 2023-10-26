
<link rel="stylesheet" type="text/css" href="style/style_header.css">
<?php
session_start();
include 'class/User.php'; // Assurez-vous d'inclure correctement le fichier User.php


$user = new User(); // Créez une instance de la classe User


if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    
    // Utilisez la méthode getUserInfo pour obtenir les données de l'utilisateur
    $userData = $user->getUserInfos($email);
}
?>


<nav>
    <header id="header">
        <div>
        <?php

                // var_dump($_SESSION["id"]);
                // var_dump($_SESSION["username"]);
            if (isset($userData)) {
                echo "Bienvenue " . $userData["nom"] . " " . $userData["prenom"];
            }
            ?>
        </div>
        <div>
            <a href="deconnexion.php">deconnexion</a>            
        </div>
    </header>
        </nav>