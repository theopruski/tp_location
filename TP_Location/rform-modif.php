<?php
if (session_status() != PHP_SESSION_ACTIVE)
   session_start();
if (!isset($_SESSION['Email'])) {
   header("location:accueil.php");
   exit;
}
$servername = "mysql-theopruski.alwaysdata.net";
$dbname = "theopruski_tp_location";
$username = "243681";
$password = "Theo040603";

$objetPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdoStat = $objetPDO->prepare('SELECT*FROM region WHERE ID=:id');
$pdoStat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$executeIsOk = $pdoStat->execute();
$region = $pdoStat->fetch();
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

      <div id="menu-btn" class="fas fa-bars icons"></div>
      <?php include("nav.php") ?>
      <div class="form-container">

         <form action="rform-update.php" method="post">
            <h3>Modification</h3>
            <input type="hidden" name="ID" value="<?= $region['ID']; ?>">
            <input type="text" name="Nom" value="<?= $region['Nom']; ?>">
            <input type="submit" value="Envoyer" name="Envoyer">
            <input type="reset" value="Effacer" name="Effacer">
         </form>
      </div>
</body>

</html>