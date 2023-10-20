<?php
session_start();
include '../class/User.php'; // Assurez-vous d'inclure correctement le fichier User.php


$user = new User(); // Créez une instance de la classe User


if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    
    // Utilisez la méthode getUserInfo pour obtenir les données de l'utilisateur
    $userData = $user->getUserInfos($email);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV-crafter</title>
    <link rel="stylesheet" type="text/css" href="../style/style_profil.css">

</head>
<body>

<?php
include '../header.php';
?>

    <div>
        <form id="form_modif_profil" method="post" action="../mod/mod_profilModif.php">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="entrez votre nom : " value="<?php echo htmlspecialchars($userData["nom"]); ?>">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" id="prenom" placeholder="entrez votre prenom : " value="<?php echo htmlspecialchars($userData["prenom"]); ?>">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="enter your email : " value="<?php echo htmlspecialchars($userData["email"]); ?>">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <label for="confirme_password">Confirme password</label>
            <input type="password" name="confirme_password" id="confirme_password">
            <input type="submit" value="Enter">
        </form>
    </div>
    <a href="calendar.php">calendrier<a>
    <a href="deconnexion.php">deconnexion</a>

    

</body>


<?php  } ?>