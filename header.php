<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV-crafter</title>
    <link rel="stylesheet" type="text/css" href="style/style_header.css">

</head>

<body>
    <header id="header">
        <div>
        <?php
            if (isset($userData)) {
                echo "Bienvenue " . $userData["nom"] . " " . $userData["prenom"];
            }
            ?>
        </div>
        <div>
            <a href="deconnexion.php">deconnexion</a>            
        </div>
    </header>
</body>