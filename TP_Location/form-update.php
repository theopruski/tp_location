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
function date_Js2Db($dateStr)
{
  //date from datetime db
  //2018-06-12 19:30:00
  if (isset($dateStr) && trim($dateStr) != "")
    return str_replace("T", " ", $dateStr);
  return "";
}

$pdoStat = $objetPDO->prepare('UPDATE client set Nom=:name, Prenom=:lastname, Email=:email, 
    Tel=:phone, Mdp=:pass, Addresse=:location, Hote=:host, DateCreation=:crea, DateModification=:modif WHERE ID=:id LIMIT 1');
$pdoStat->bindValue(':id', $_POST['ID'], PDO::PARAM_INT);
$pdoStat->bindValue(':name', $_POST['Nom'], PDO::PARAM_STR_CHAR);
$pdoStat->bindValue(':lastname', $_POST['Prenom'], PDO::PARAM_STR_CHAR);
$pdoStat->bindValue(':email', $_POST['Email'], PDO::PARAM_STR_CHAR);
$pdoStat->bindValue(':phone', $_POST['Tel'], PDO::PARAM_INT);
$pdoStat->bindValue(':pass', $_POST['Mdp'], PDO::PARAM_STR_CHAR);
$pdoStat->bindValue(':location', $_POST['Addresse'], PDO::PARAM_STR_CHAR);
$pdoStat->bindValue(':host', $_POST['Hote'], PDO::PARAM_INT);
$pdoStat->bindValue(':crea', date_Js2Db($_POST['DateCreation'], PDO::PARAM_INT));
$pdoStat->bindValue(':modif', date_Js2Db($_POST['DateModification'], PDO::PARAM_INT));

$executeIsOk = $pdoStat->execute();
if ($executeIsOk) {
  $message = "Client modifié";
} else {
  $message = "Client non modifié";
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