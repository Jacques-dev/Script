


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

  function addEvent($textEvent, $predEvent, $scriptEvent) {

    include("../BDD/Connexion.php");

    $sql = $con->prepare("INSERT INTO event (text,pred,script) VALUES (?, ?, ?)");
    $sql->bind_param('sii', $text, $pred, $script);

    $text = $textEvent;
    $pred = $predEvent;
    $script = $scriptEvent;

    $sql->execute();
  }

  function updateEvent($textEvent, $idEvent) {

    include("../BDD/Connexion.php");

    $sql = $con->prepare("UPDATE event SET text = ? WHERE ide = ?");
    $sql->bind_param('si', $text, $id);

    $text = $textEvent;
    $id = $idEvent;

    $sql->execute();
  }

  function insertEvent($textEvent, $predEvent, $scriptEvent) {

    include("../BDD/Connexion.php");

    $sql = $con->prepare("INSERT INTO event (text,pred,script) VALUES (?, ?, ?)");
    $sql->bind_param('sii', $text, $pred, $script);

    $text = $textEvent;
    $pred = $predEvent;
    $script = $scriptEvent;

    $sql->execute();
  }

?>
