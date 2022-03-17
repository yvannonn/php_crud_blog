<?php
// on traite le document

if (!empty($_POST)) {

    //POST n' est pas vide, on sérifie si les données sont présentes

    if (
        isset($_POST["titre"], $_POST["contenu"])   &&

        !empty($_POST["titre"]) && !empty($_POST["contenu"])
    ) {

        // le fomulaire est complet 
        // on recupere les données en les protégeant 
        require_once "../includes/connect.php";

        $titre = strip_tags($_POST["titre"]);

        $contenu = htmlspecialchars($_POST["contenu"]);

        // on ecrit la requete

        $sql = "INSERT INTO `article`(`titre`,`contenu`)VALUES(:titre,:contenu)";

        //On prepare la requete 

        $requete = $db->prepare($sql);

        if (!$requete->execute(
            array(
                ':titre' => $titre,
                ':contenu' => $contenu
            )
        )) {

            die("une erreur est survenue ");
        }
        $id = $db->lastInsertId();

        die("articke récupéré sous le numero " . $id);
    } else {
        die("le formulaire est incomplet");
    }
}

$titre = "AJouter article";
//on inclut le header

require_once "../includes/header.php";
require_once "../includes/navbar.php";
?>

<h1> ajaouter un article</h1>

<form action="" method="post">


    <div>
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre">

    </div>
    <div>
        <label for="contenu">Titre</label>
        <input type="text" name="contenu" id="contenu">

    </div>
    <input type="submit" value="Valider">
</form>
<?php
require_once "../includes/footer.php";
