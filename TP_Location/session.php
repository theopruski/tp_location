<?php

$servername = "mysql-theopruski.alwaysdata.net";
$dbname = "theopruski_tp_location";
$username = "243681";
$password = "Theo040603";
$message = "";
$email = "";

if (isset($_POST['Connexion'])) {
   try {
      $objetPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $pdoStat = $objetPDO->prepare('SELECT * FROM client WHERE Email=:email AND Mdp=:pass');
      $email = $_POST['Email'];
      $mdp = $_POST['Mdp'];
      $pdoStat->bindValue(':email', $email, PDO::PARAM_STR_CHAR);
      $pdoStat->bindValue(':pass', $mdp, PDO::PARAM_STR_CHAR);
      $pdoStat->execute();

      $count = $pdoStat->rowCount();
      $rows = $pdoStat->fetch(PDO::FETCH_ASSOC);
      if ($count == 1 && !empty($rows)) {
         session_start();
         $_SESSION['Email'] = $rows["Email"];
         $message = "Connexion réussi";
         header("location: client.php");
      } else {
         $message = "Impossible de se connecter vérifier vos identifiant.";
      }
   } catch (PDOException $err) {
      echo "Une erreur c'est produite: " + $err->getMessage();
      $message = "Une erreur c'est produite.";
   }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TP Location</title>
   <link rel="stylesheet" href="style.css">

</head>

<body>
   <header class="header">
      <p><?php echo $message ?></p>
      <div id="menu-btn" class="fas fa-bars icons"></div>
      <?php include("nav.php") ?>
      <div class="form-container">
         <form method="post">
            <h3>Connexion</h3>
            <input type="email" name="Email" required placeholder="Votre Email">
            <input type="password" name="Mdp" required placeholder="Votre Mdp">
            <input type="submit" value="Connexion" name="Connexion">
            <input type="reset" value="Effacer" name="Effacer">
         </form>
      </div>
</body>

</html>