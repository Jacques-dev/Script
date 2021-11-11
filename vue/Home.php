
<?php
  include("../model/Event.php");
  session_start();
  include("../BDD/Connexion.php");
  include("../controller/Functions.php");
  include("../controller/EventsManagment.php");

  if (isset($_SESSION["pseudo"])) {
    $pseudo = $_SESSION["pseudo"];
  } else {
    $_SESSION["pageIs"] = "Presentation.php";
  }

  if (isset($_SESSION["cookie"])) {
    $pseudoCookie = $_SESSION["cookie"][0];
    $passwordCookie = $_SESSION["cookie"][1];
    $timeCookie = $_SESSION["cookie"][2];

    $array = array($pseudoCookie, $passwordCookie, $timeCookie);
    $values = implode(",", $array);

    setcookie("RememberMe", $values, time() + 60 * 60 * 24 * 365);
    unset($_SESSION["cookie"]);
  }

  if (isset($_SESSION["cookiechecked"]) && $_SESSION["cookiechecked"] === false) {
    header('Location: ../controller/CheckCookie.php');
  }

  if (isset($_SESSION["logout"])) {
    unset($_COOKIE["RememberMe"]);
    setcookie("RememberMe", "", time() - 3600);
    unset($_SESSION["logout"]);
  }

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Link CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/script.css">
  	<!-- icone CSS -->
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  	<!-- Boostrap SCRIPT -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Popup CSS -->
    <link href="https://cdn.isfidev.net/asalertmessage/v1.0/css/as-alert-message.min.css" rel="stylesheet">
    <script src="https://cdn.isfidev.net/asalertmessage/v1.0/js/as-alert-message.min.js"></script>
	</head>
	<body>

    <nav>
      <nav1></nav1>
      <div id="connexion_creation_buttons">
        <form action="Connexion.php" method="post">
          <?php if (isset($pseudo)){ ?>
            <button type="submit" name="logout">Déconnexion</button>
          <?php } else { ?>
            <button type="submit" name="connexion">Connexion</button>
          <?php } ?>
        </form>
      </div>
      <nav2></nav2>
      <div id="listOfScripts">
        <?php if (isset($pseudo)){ ?>
          <button type="submit" name="addScript" onclick="openScriptAddingPan()">Créer script</button>
          <form action="Home.php" method="post" id="newScript">
            <input type="text" name="scriptName" placeholder="nom">
            <button type="submit" name="addNewScript">Valider</button>
          </form>

          <?php

            if(isset($_POST["addNewScript"])) {
              if (!empty($_POST["scriptName"])) {
                $sql = $con->prepare("INSERT INTO script (name, pseudo) VALUES (?, ?)");
                $sql->bind_param('ss', $name, $pseudo);
                $name = $_POST["scriptName"];
                $pseudo = $_SESSION["pseudo"];
                $sql->execute();
              }
            } elseif (isset($_POST["renameScript"])) {
              $sql = "UPDATE script SET name = '".$_POST['scriptName']."' WHERE ids = ".$_POST['scriptInfo'];
              $result = $con->query($sql);
            } elseif (isset($_POST["deleteScript"])) {
              $sql = "DELETE FROM script WHERE ids = ".$_POST['scriptInfo'];
              $result = $con->query($sql);
            } elseif (isset($_POST["edit"])) {
              $_SESSION["ids"] = explode(":",$_POST["scriptInfo"])[0];
              $_SESSION["scriptName"] = explode(":",$_POST["scriptInfo"])[1];
              $_SESSION["startingScript"] = True;
              $_SESSION["pageIs"] = "Script.php";
            }
            $sql = "SELECT ids, name FROM script WHERE pseudo = '$pseudo'";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {?>
              <form action="Home.php" method="post"><?php
                echo "<input type='hidden' value='".$row["ids"].":".$row["name"]."' name='scriptInfo'/>";
                echo "<button type='submit' name='edit'>".$row["name"]."</button>";
                echo "<button type='submit' name='deleteScript'>Supprimer</button>";?>
                <?php echo "<br>";?>
              </form><?php
            }
          } ?>
      </div>
      <nav3></nav3>
      <div id="webSiteName">
        SCRIPT.COM
      </div>
    </nav>

    <content>
      <div class="container-fluid">
        <?php include("".$_SESSION["pageIs"]."");?>
      </div>
    </content>

    <script src="../js/script.js"></script>

  </body>
</html>
