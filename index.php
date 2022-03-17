<?php

//on demarre donc une session 
session_start();
//inserer les includes
include_once "includes/header.php";
include_once "includes/navbar.php";

?>
<h1>Contenu de la page d' acceuil</h1>

<?php
//Connexion à la base de donnée 

$email = "ssmyvan01@gmail.com";

require_once "includes/connect.php";

$sql = "SELECT * FROM `users` WHERE `email`=:email";

$requete = $db->prepare($sql);

//on injecte les valeurs avec bindvalue 

$requete->bindValue(':email', $email, PDO::PARAM_STR);

//on execute

$requete->execute();
$user = $requete->fetchAll();

echo "<pre>";
var_dump($user);
echo "</pre>";









include_once "includes/footer.php";
