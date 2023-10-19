<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="">

</head>
<body>
    <div>
        <h2>Inscription</h2>
        <form id="form_inscription" method="post" action="../mod/mod_inscription.php">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="entrez votre nom : ">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" id="prenom" placeholder="entrez votre prenom : ">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="entrez votre email : ">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <label for="confirme_password">Confirme password</label>
            <input type="password" name="confirme_password" id="confirme_password">
            <input type="submit" value="Enter">
        </form>
        <a href="connexion.php">Connexion</a>
    </div>
</body>