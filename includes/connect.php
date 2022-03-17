<?php

// on declare les constantes d' environnemrnt 

define("DBHOST", "localhost");
define("DBNAME", "tuto-php");
define("DBUSER", "root");
define("DBPASS", "");

//le DSN de la connexion

$dsn = "mysql:dbname=" . DBNAME . ";hostname=" . DBHOST;

//connexion à la base 

try {
    $db = new PDO($dsn, DBUSER, DBPASS);

    echo "Connexion à la base de donnéé Réussie";
    $sql = "INSERT INTO `users` (`id`,`email`,`pass`,`role`) VALUES('','$','[\"ROLE_USER\"]')";

    //envoi des données en utf8
    $db->exec("SET NAMES UTF8");
} catch (PDOException $e) {

    die("erreur" . $e->getMessage());
}

switch ($info["mime"]) {
    case "image/png":
        // on enregistre 
        imagepng($nouvelleimage, __DIR__ . "/uploadscrop-" . $fichier);
        break;
    case "image/jeg":
        // on enregistre l' image 
        imagejpeg($nouvelleimage, __DIR__ . "/uploadscrop-" . $fichier);
        break;
}
imagedestroy($nouvelleimage);
