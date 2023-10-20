<?php
include "../class/User.php";
session_start();

$user = new User();
// var_dump($_SESSION["id"]);
// var_dump($_POST['date']);  
// var_dump($_POST['titre']);  
// var_dump($_POST['description']);  
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_SESION["id"])) {
    // Récupère les données POST envoyées depuis JavaScript.
    $date = $_POST['date'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $is_user = $_SESSION['id'];

    $user->saveEvent($is_user, $date, $titre, $description);

}