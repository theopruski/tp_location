<?php
session_start();
$session = "session.php";
$lib = "login";
if (isset($_SESSION['Email'])) {
    $session = "logout.php";
    $lib = "logout";
}
?>
<nav class="navbar">
    <a href="https://theopruski.alwaysdata.net/TP_Location/accueil.php">Accueil</a>
    <?php if (isset($_SESSION['Email'])) : ?>
        <a href="https://theopruski.alwaysdata.net/TP_Location/register.php">Formulaire</a>
        <a href="https://theopruski.alwaysdata.net/TP_Location/client.php">Utilisateurs</a>
        <a href="https://theopruski.alwaysdata.net/TP_Location/region.php">Régions</a>
        <a href="https://theopruski.alwaysdata.net/TP_Location/typeimmo.php">Type Immo</a>
        <a href="https://theopruski.alwaysdata.net/TP_Location/annonce.php">Annonce</a>
    <?php endif; ?>
    <a href="https://theopruski.alwaysdata.net/TP_Location/<?= $session ?>"><?= $lib ?></a>
</nav>