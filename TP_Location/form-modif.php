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
$pdoStat = $objetPDO->prepare('SELECT*FROM client WHERE ID=:id');
$pdoStat->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$executeIsOk = $pdoStat->execute();
$client = $pdoStat->fetch();

function date_Db2Js($dateStr)
{
   if (!isset($dateStr))
      return "";
   //date from datetime html
   //2018-06-12T19:30
   //if(DateTime::createFromFormat('Y-m-d H:i:s', $myString) !== false)
   if (strtotime($dateStr))
      return str_replace(" ", "T", $dateStr);
   return "";
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

      <div id="menu-btn" class="fas fa-bars icons"></div>
      <?php include("nav.php") ?>
      <div class="form-container">

         <form action="form-update.php" method="post">
            <h3>Modification</h3>
            <input type="hidden" name="ID" value="<?= $client['ID']; ?>">
            <input type="text" name="Nom" value="<?= $client['Nom']; ?>">
            <input type="text" name="Prenom" value="<?= $client['Prenom']; ?>">
            <input type="email" name="Email" value="<?= $client['Email']; ?>">
            <input type="phone" name="Tel" value="<?= $client['Tel']; ?>">
            <input type="password" name="Mdp" value="<?= $client['Mdp']; ?>">
            <input type="text" name="Addresse" value="<?= $client['Addresse']; ?>">
            <select name="Hote" value="<?= $client['Hote']; ?>">
               <option value=0>Client</option>
               <option value=1>Hote</option>
            </select>
            <input type="datetime-local" name="DateCreation" required="" value="<?= date_Db2Js($client['DateCreation']); ?>">
            <input type="datetime-local" name="DateModification" required="" value="<?= date_Db2Js($client['DateModification']); ?>">
            <input type="submit" value="Envoyer" name="Envoyer">
            <input type="reset" value="Effacer" name="Effacer">
         </form>
      </div>
</body>

</html>