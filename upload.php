<?php
// on verifie si un fichier a ete envoyé 

if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {

    // on a recu l' image 
    //on procède aux vérifications

    // on vérifie l' extension et le type mime

    $allowed = [

        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "png" => "image/png",
        "pdf" => "application/pdf"
    ];

    $filename = $_FILES["image"]["name"];
    $filetype = $_FILES["image"]["type"];
    $filesize = $_FILES["image"]["size"];


    //verification extension et type mime 

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    // on verifie l' absence de l' extension dans les clés de $allowed ou 


    if (!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)) {

        die("erreur format de fichier incorrect");
    }

    //ici le fichier est correct
    // on limite la taille 

    if ($filesize > 1024 * 1024) {

        die("fichier trop volumineux ");
    }

    // on genère un nouveau nom

    $newname =  md5(uniqid());

    // on génère le chemin comlet 
    $newfilename = __DIR__ . "/uploads/$newname.$extension";

    // on deplace le fichier en le renommant 
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $newfilename)) {
        die("l' upload ne fonctionne pas");
    }
    chmod($newfilename, 0644);
}
?>
<html>

<head>
    <title><?= $titre ?></title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<h1>Ajout de fichier </h1>
<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="fichier"></label>
        <input type="file" name="image" id="fichier">
    </div>
    <button type="submit">Soumettre</button>

</form>

</html>