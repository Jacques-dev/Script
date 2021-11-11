

<?php

  include("BDD/Connexion.php");

  function printEvents($nb, $events, $ide) {
    $width = 20;
    $height = 20;
    for ($i = 0 ; $i != $nb ; $i++) {
      ?>
      <form class="eventForm" style="width: <?= $width; ?>vw; height: <?= $height; ?>vh" action="Home.php" method="post">
        <input type="hidden" name="predEvent" value="<?= $events[$i]->getID(); ?>">
        <button type="submit" name="checkNextEvents">
          <div class="event" style="width: <?= $width; ?>vw; height: <?= $height; ?>vh">
            <?= $events[$i]->getText(); ?>
          </div>
        </button>
      </form>
      <?php
    }

  }

  if ($_SESSION["startingScript"] == True) {
    $ids = $_SESSION['ids'];
    $sql = "SELECT * FROM event WHERE script = '$ids' AND pred IS NULL";
    $result = $con->query($sql);

    $res = [];
    while ($object = $result->fetch_object("Event")) {
      array_push($res, $object);
    }
    $_SESSION["eventsToPrint"] = $res;
    $_SESSION["startingScript"] = False;
  } else {
    if(isset($_POST["checkNextEvents"])) {
      $ide = $_POST["predEvent"];
      $sql = "SELECT * FROM event WHERE pred = $ide";
      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        $res = [];
        while ($object = $result->fetch_object("Event")) {
          array_push($res, $object);
        }
        $_SESSION["eventsToPrint"] = $res;
      } else {
        $_SESSION["pred"] = $_SESSION["eventsToPrint"][0]->getID();
      }
    }
  }

?>

<div id="mode">
  <?= $_SESSION["scriptName"]; ?>
</div>

<div id="content">
  <?php
    printEvents(sizeof($_SESSION["eventsToPrint"]), $_SESSION["eventsToPrint"], $_SESSION["pred"]);
  ?>
</div>
