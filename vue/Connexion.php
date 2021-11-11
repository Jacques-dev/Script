
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<!-- Link CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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

    <div id="connexionPage"></div>

    <?php if(isset($_POST["connexion"]) || isset($_POST["alreadyHaveAccount"])) { ?>
        <form action="Connexion.php" method="post" id="connexionForm">
          <input type="pseudo" name="pseudo" placeholder="Pseudo"><br>
          <input type="password" name="password" placeholder="Mot de passe"><br>
          <button type="submit" name="submitConnexion">Se connecter</button>
          <input type="checkbox" name="remember" id="remember">
          <label for="remember">Se souvenir de moi</label><br>
          <input type="submit" name="noAccount" value="Je n'ai pas de compte">
        </form>
    <?php } if(isset($_POST["noAccount"])) { ?>
      <form action="Connexion.php" method="post" id="connexionForm">
        <input type="pseudo" name="pseudo" placeholder="Pseudo"><br>
        <input type="password" name="password" placeholder="Mot de passe"><br>
        <button type="submit" name="submitRegister">S'enregistrer</button><br>
        <input type="submit" name="alreadyHaveAccount" value="J'ai déjà un compte">
      </form>
    <?php }

      include("../BDD/Connexion.php");
      session_start();

      if(isset($_POST["submitConnexion"])) {
        if (!empty($_POST["pseudo"]) && !empty($_POST["password"])) {

          $pseudo = $_POST['pseudo'];
          $sql = "SELECT password FROM user WHERE pseudo = '$pseudo'";

          $result = $con->query($sql);

          $row = $result->fetch_assoc();

          if ($result->num_rows == 1) {

            $decrypted_txt = encrypt_decrypt('decrypt', $row['password']);

            if ($decrypted_txt == $_POST['password']) {

              $_SESSION["pseudo"] = $pseudo;

              if (isset($_POST["remember"])) {
                $time = time()*60*60*24*365;  //STOCKS 1 YEAR IN THE VAR
                $_SESSION["cookie"] = array($pseudo, $row['password'], $time);
              }

            }

          }

        }
        header('Location: Home.php');
        exit();
      }

      if (isset($_POST['submitRegister'])) {

        if (!empty($_POST["pseudo"]) && !empty($_POST["password"])) {

          $pseudo = $_POST['pseudo'];

          $sql = $con->prepare("INSERT INTO user (pseudo, password) VALUES (?, ?)");
          $sql->bind_param('ss', $pseudo, $password);

          $sqlTest = "SELECT * FROM user WHERE pseudo = '".$pseudo."'";
          $result = $con->query($sqlTest);

          if ($result->num_rows == 0) {

            $pseudo = $_POST['pseudo'];
            $password = encrypt_decrypt('encrypt', $_POST['password']);

            $sql->execute();

          }

        }
        header('Location: Home.php');
        exit();
      }

      if (isset($_POST['logout'])) {
        if (isset($_SESSION["pseudo"])) {
          session_destroy();
          session_start();
          $_SESSION["logout"] = true;
        }
        header('Location: Home.php');
        exit();
      }

      function encrypt_decrypt($action, $string) {
        $secret_key = "SCRIPT";
        $output = false;
        $encrypt_method = "AES-256-CBC";
        //
        $secret_iv = 'This is my secret iv';
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
          $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
          $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
      }

    ?>

  </body>
</html>
