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

$pdoStat = $objetPDO->prepare('UPDATE region set Nom=:namer WHERE ID=:id LIMIT 1');
$pdoStat->bindValue(':id', $_POST['ID'], PDO::PARAM_INT);
$pdoStat->bindValue(':namer', $_POST['Nom'], PDO::PARAM_STR_CHAR);

$executeIsOk = $pdoStat->execute();
if ($executeIsOk) {
  $message = "Région modifié";
} else {
  $message = "Région non modifié";
  print_r($pdoStat->errorInfo());
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
  <header class="header">

    <div id="menu-btn" class="fas fa-bars icons"></div>
    <?php include("nav.php") ?>
</head>

<body>
  <h1>Modification</h1>
  <p><?= $message ?></p>
</body>

</html>