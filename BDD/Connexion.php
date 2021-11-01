

<?php

  include("Parametre.php");

  $con = new mysqli($hote, $user, $pass, $base);

  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }

  $con->set_charset("utf8mb4");

?>
