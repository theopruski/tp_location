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

      $name = $_POST['Nom'];
      $lastname = $_POST['Prenom'];
      $email = $_POST['Email'];
      $phone = $_POST['Tel'];
      $pass = $_POST['Mdp'];
      $location = $_POST['Addresse'];
      $host = $_POST['Hote'];
      $crea = $_POST['DateCreation'];
      $modif = $_POST['DateModification'];

      $sql = ("INSERT INTO `client`(`Nom`, `Prenom`, `Email`, `Tel`, `Mdp`, `Addresse`, `Hote`, `DateCreation`, `DateModification`) VALUES ('$name','$lastname','$email','$phone','$pass','$location','$host','$crea','$modif')");
      $stmt = $conn->prepare($sql);
      $stmt->bindParam('Nom', $name);
      $stmt->bindParam('Prenom', $lastname);
      $stmt->bindParam('Email', $email);
      $stmt->bindParam('Tel', $phone);
      $stmt->bindParam('Mdp', $pass);
      $stmt->bindParam('Addresse', $location);
      $stmt->bindParam('Host', $host);
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
            <input type="text" name="Nom" required placeholder="Votre Nom">
            <input type="text" name="Prenom" required placeholder="Votre Prenom">
            <input type="email" name="Email" required placeholder="Votre Email">
            <input type="phone" name="Tel" required placeholder="Votre Tel">
            <input type="password" name="Mdp" required placeholder="Votre Mdp">
            <input type="text" name="Addresse" required placeholder="Votre Adresse">
            <select name="Hote">
               <option value=0>Client</option>
               <option value=1>Hote</option>
            </select>
            <input type="datetime-local" name="DateCreation" required="">
            <input type="datetime-local" name="DateModification" required="">
            <input type="submit" value="Envoyer" name="Envoyer">
            <input type="reset" value="Effacer" name="Effacer">
         </form>
      </div>
</body>

</html>