<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (!isset($_SESSION['Email'])) {
  header("location:accueil.php");
  exit;
}
$host = 'mysql-theopruski.alwaysdata.net';
$dbname = 'theopruski_tp_location';
$username = '243681';
$password = 'Theo040603';

$dsn = "mysql:host=$host;dbname=$dbname";
$sql = "SELECT * FROM client";

try {
  $pdo = new PDO($dsn, $username, $password);
  $stmt = $pdo->query($sql);
  if ($stmt === false) {
    die("Erreur");
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html>

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
    <link rel="stylesheet" href="style.css">
    <div class="form-client">
      <center>
        <h1 class="donnee">Base de donnees</h1>

        <head>Afficher la table client</head>

        <body>
          <h1>Liste des utilisateurs</h1>
          <a href="register.php">
            <input type="button" value="✅ Ajouter">
          </a>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Mdp</th>
                <th>Adresse</th>
                <th>Hote</th>
                <th>Date Creation</th>
                <th>Date Modification</th>
                <th>Supprimer</th>
                <th>Modifier</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                  <td><?php echo htmlspecialchars($row['ID']); ?></td>
                  <td><?php echo htmlspecialchars($row['Nom']); ?></td>
                  <td><?php echo htmlspecialchars($row['Prenom']); ?></td>
                  <td><?php echo htmlspecialchars($row['Email']); ?></td>
                  <td><?php echo htmlspecialchars($row['Tel']); ?></td>
                  <td><?php echo htmlspecialchars($row['Mdp']); ?></td>
                  <td><?php echo htmlspecialchars($row['Addresse']); ?></td>
                  <td><?php echo htmlspecialchars($row['Hote']); ?></td>
                  <td><?php echo htmlspecialchars($row['DateCreation']); ?></td>
                  <td><?php echo htmlspecialchars($row['DateModification']); ?></td>
                  <td>
                    <center><a href="https://theopruski.alwaysdata.net/TP_Location/delete.php?action=delete&id=<?= $row['ID'] ?>"><input type="button" value="❌" name="❌"></center></a>
                  </td>
                  <td>
                    <center><a href="https://theopruski.alwaysdata.net/TP_Location/form-modif.php?action=modif&id=<?= $row['ID'] ?>"><input type="button" value="✏" name="✏"></center></a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
      </center>
    </div>
</body>

</html>