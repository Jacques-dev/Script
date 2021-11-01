

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
    edit
    <form action="Home.php" method="post">
      <input type="text" name="addQ" placeholder="Add question">
    </form>
  <?php } if(isset($_POST["use"])) { ?>
    use
  <?php } ?>
</div>
