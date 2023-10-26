<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
  <link rel="stylesheet" type="text/css" href="../style/calendar.css">
</head>
<body>
    <div>
    <?php
     include '../header.php';
     $user = new User();
     var_dump($_SESSION["id"]);
      ?>
     </div>

  <div id="calendar"></div>
  <button id="openPopupButton">Ajouter un événement</button>

  <div id="event-details"></div>
<?php
  $allEvent = $user->getAllEvent($_SESSION['id']);
  var_dump($allEvent);
  ?>
  <script src="../script/script_calendar.js"></script>
</body>
</html>
