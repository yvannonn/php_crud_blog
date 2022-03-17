<?php

// nom du fichier a manipuler 

$fichier = "2339d33b0edb5234bce37b5ad7cbf9e6.png";
$image = __DIR__ . "/uploads/" . $fichier;

$info = getimagesize($image);
var_dump($info);

//

$largeur = $info[0];
$hauteur = $info[1];

// on créé une nouvelle image vierege en mémoire 
$nouvelleimage = imagecreatetruecolor($largeur / 2, $hauteur / 2);

switch ($info["mime"]) {

    case "image/png":
        $imagesource = imagecreatefrompng($image);

        break;

    case "image/jpeg":
        $imagesource = imagecreatefromjpeg($image);

        break;
    default:
        die("Format d' image incorrect");
}


// on copie l' image source dans l' image destination en ma reduisant 

imagecopyresampled(
    $nouvelleimage, // image de destination
    $imagesource, // image de depart
    0, //position en x du coin superieur h=gauche
    0, //pos y  ************************
    0, //dans l' image source
    0, // dans l' image source
    $largeur / 2, // largeur dans image de destination
    $hauteur / 2, //hauteur********
    $largeur, // largeur dans image source
    $hauteur, //hauteur******** source

);

// on enregistre l' image sur le serveur 

switch ($info["mime"]) {
    case "image/png":
        // on enregistre 
        imagepng($nouvelleimage, __DIR__ . "/uploads/resize-" . $fichier);
        break;
    case "image/jeg":
        // on enregistre l' image 
        imagejpeg($nouvelleimage, __DIR__ . "/uploads/resize-" . $fichier);
        break;
}

// on detruit l' image dans la memoire 

imagedestroy($imagesource);
