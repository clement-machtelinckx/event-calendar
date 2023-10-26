<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: ../page/connexion.php');
    exit;
}
$id_user = $_SESSION['id'];
include '../class/User.php';
$user = new User;
$id_user = $_SESSION['id'];

$event = $user->getAllEvent($id_user);
header('Content-Type: application/json');
$eventJson = json_encode($event);
echo $eventJson;

// var_dump($eventJson);