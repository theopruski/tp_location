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

if (isset($_POST['Envoyer'])) {
   try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $prix = $_POST['Prix'];
      $alocation = $_POST['Adresse'];
      $cid = $_POST['client_ID'];
      $tid = $_POST['typeimmobilier_ID'];
      $rid = $_POST['region_ID'];
      $crea = $_POST['DateCreation'];
      $modif = $_POST['DateModification'];

      $sql = ("INSERT INTO `annonce`(`Prix`, `Adresse`, `DateCreation`, `DateModification`, `client_ID`, `typeimmobilier_ID`, `region_ID`) VALUES ('$prix','$alocation','$cid','$tid','$rid','$crea','$modif')");
      $stmt = $conn->prepare($sql);
      $stmt->bindParam('Prix', $prix);
      $stmt->bindParam('Adresse', $alocation);
      $stmt->bindParam('client_ID', $cid);
      $stmt->bindParam('typeimmobilier_ID', $tid);
      $stmt->bindParam('region_ID', $rid);
      $stmt->bindParam('DateCreation', $crea);
      $stmt->bindParam('DateModification', $modif);

      if ($stmt->execute()) {
         echo '<script>alert("Enregistré avec succès");</script>';
      } else {
         $error = "Erreur: " . $e->getMessage();
         echo '<script>alert("' . $error . '");</script>';
      }
   } catch (PDOException $e) {
      $error = "Erreur: " . $e->getMessage();
      echo '<script>alert("' . $error . '");</script>';
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

      <div id="menu-btn" class="fas fa-bars icons"></div>
      <?php include("nav.php") ?>
      <div class="form-container">

         <form action="" method="post">
            <h3>Enregistrement</h3>
            <input type="text" name="Prix" required placeholder="Votre Prix">
            <input type="text" name="Adresse" required placeholder="Votre Adresse">
            <input type="text" name="region_ID" required placeholder="Entrer une Région">
            <input type="text" name="typeimmo_ID" required placeholder="Votre Location">
            <input type="text" name="Libelle" required placeholder="Vos Pièces">
            <input type="text" name="Libelle" required placeholder="Vos Services">
            <input type="text" name="client_ID" required placeholder="Votre Nom">
            <input type="datetime-local" name="DateCreation" required="">
            <input type="datetime-local" name="DateModification" required="">
            <input type="submit" value="Envoyer" name="Envoyer">
            <input type="reset" value="Effacer" name="Effacer">
         </form>
      </div>
</body>

</html>