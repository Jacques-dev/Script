


<?php

  function deleteEvent($ide) {

    include("../BDD/Connexion.php");

    $sql = $con->prepare("DELETE FROM event WHERE ide = ?");
    $sql->bind_param('i', $ide);

    $ide = $_POST["idEvent"];

    $sql->execute();

    $sql = "DELETE FROM event WHERE pred NOT IN (SELECT ide FROM event)";
    $con->query($sql);

  }

?>
