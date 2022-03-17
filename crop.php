<?php
$fichier = "2339d33b0edb5234bce37b5ad7cbf9e6.png";
$image = __DIR__ . "/uploads/" . $fichier;

$info = getimagesize($image);
//var_dump($info);


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


// on recadre l' image avec imagecrop

$nouvelleimage = imagecrop($imagesource, [
    "x" => 200,
    "y" => 200,
    "width" => 500,
    "height" => 150
]);

switch ($info["mime"]) {
    case "image/png":
        // on enregistre 
        imagepng($nouvelleimage, __DIR__ . "/uploads/crop-" . $fichier);
        break;
    case "image/jeg":
        // on enregistre l' image 
        imagejpeg($nouvelleimage, __DIR__ . "/uploads/crop-" . $fichier);
        break;
}
imagedestroy($nouvelleimage);
