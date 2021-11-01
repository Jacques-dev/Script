

<?php

  include("BDD/Connexion.php");

?>

<div id="mode">
  <form action="Home.php" method="post">
    <button type="submit" name="edit">Éditer</button>
    <button type="submit" name="use">Utiliser</button>
  </form>
</div>

<div id="content">
  <?php if(isset($_POST["edit"])) { ?>
    <?php
      $tableau = []

    ?>
    <button type="button" name="button" onclick=""></button>
    

    <?= $_SESSION["scriptName"]; ?>

  <?php } if(isset($_POST["use"])) { ?>
    use
  <?php } ?>
</div>
