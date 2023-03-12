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

      $nameti = $_POST['Nom'];

      $sql = ("INSERT INTO `typeimmobilier`(`Libelle`, `PrixMin`) VALUES ('$nameti', '$pricemin')");
      $stmt = $conn->prepare($sql);
      $stmt->bindParam('Nom', $nameti);
      $stmt->bindParam('Nom', $pricemin);

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
            <input type="text" name="Libelle" required placeholder="Votre bien">
            <input type="text" name="PrixMin" required placeholder="Votre prix">
            <input type="submit" value="Envoyer" name="Envoyer">
            <input type="reset" value="Effacer" name="Effacer">
         </form>
      </div>
</body>

</html>