<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="">

</head>
<body>
    <h1>Connexion</h1>
    <form id="form_connexion" method="post" action="../mod/mod_connexion.php">
    <label for="email">email</label>
    <input type="text" name="email" id="email">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Enter">
    
    </form>
    <a href="inscription">Inscription</a>
    <a href="../index.php">Index</a>
</body>