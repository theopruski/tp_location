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
$sql = "SELECT a.ID, a.Prix, a.Publication, a.Adresse, a.DateCreation, 
  a.DateModification, a.client_ID, c.Nom as nomclient, a.typeimmobilier_ID, a.region_ID, t.Libelle as nomimmo, r.Nom as rnom
  FROM annonce  as a 
    inner join client as c on c.ID=a.client_ID
      inner join typeimmobilier as t on t.ID=a.typeimmobilier_ID
      left join region as r on r.ID=a.region_ID
  ;";

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

        <head>Afficher la table annonces</head>

        <body>
          <h1>Liste des annonces</h1>
          <a href="rannonce.php">
            <input type="button" value="✅ Ajouter">
          </a>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Prix</th>
                <th>Adresse</th>
                <th>Region</th>
                <th>Type</th>
                <th>Piece</th>
                <th>Service</th>
                <th>Client</th>
                <th>Date de Creation</th>
                <th>Date de Modification</th>
                <th>Supprimer</th>
                <th>Modifier</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                  <td><?php echo htmlspecialchars($row['ID']); ?></td>
                  <td><?php echo htmlspecialchars($row['Prix']); ?></td>
                  <td><?php echo htmlspecialchars($row['Adresse']); ?></td>
                  <td><?php echo htmlspecialchars($row['rnom']); ?></td>
                  <td><?php echo htmlspecialchars($row['nomimmo']); ?></td>
                  <td><?php echo htmlspecialchars($row['Libelle']); ?></td>
                  <td><?php echo htmlspecialchars($row['Libelle']); ?></td>
                  <td><?php echo htmlspecialchars($row['nomclient']); ?></td>
                  <td><?php echo htmlspecialchars($row['DateCreation']); ?></td>
                  <td><?php echo htmlspecialchars($row['DateModification']); ?></td>
                  <td>
                    <center><a href="https://theopruski.alwaysdata.net/TP_Location/adelete.php?action=delete&id=<?= $row['ID'] ?>"><input type="button" value="❌" name="❌"></center></a>
                  </td>
                  <td>
                    <center><a href="https://theopruski.alwaysdata.net/TP_Location/aform-modif.php?action=modif&id=<?= $row['ID'] ?>"><input type="button" value="✏" name="✏"></center></a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
      </center>
    </div>
</body>

</html>