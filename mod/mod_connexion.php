<?php
session_start();
include '../class/User.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créez une instance de la classe User
    $user = new User();

    $email = $_POST["email"];

    $password = $_POST["password"];



    // Appelez la méthode inscripUser pour enregistrer l'utilisateur
    $user->connecUser($email, $password);
    header("Location: ../page/profil.php");
    exit;
}


?>
