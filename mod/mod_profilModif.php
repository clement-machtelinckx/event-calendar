<?php
session_start();
include '../class/User.php';

$user = new User();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    $userData = $user->getUserInfos($email);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirme_password = $_POST["confirme_password"];

    if (isset($_POST["password"]) && isset($_POST["confirme_password"])){
        // Vérifiez que le mot de passe correspond à la confirmation du mot de passe
        if ($password === $confirme_password) {
            // Appelez la méthode profileModif pour mettre à jour les informations de l'utilisateur
            $user->profileModif($nom, $prenom, $email, $password);

            // Redirigez l'utilisateur vers une page de confirmation ou une autre page de profil
            header('Location: ../page/profil.php');
            exit;
        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    }
    else{
        echo "pls confirme password";
    }
}
?>