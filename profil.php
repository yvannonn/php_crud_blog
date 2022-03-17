<?php
session_start();
//inserer les includes
include_once "includes/header.php";
include_once "includes/navbar.php";

?>
<h1>Profil de <?= $_SESSION["user"]["email"] ?></h1>

<?php






include_once "includes/footer.php";
