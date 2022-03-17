<?php

if (isset($_SESSION["user"])) {

    header("Location: profil.php");
    exit;
}
session_start();
//on vérifie si le formulaire à été envoyé 
if (!empty($_POST)) {
    //le formulaire a été envoyé 
    //on vérifie si les champs sont complets
    if (
        isset($_POST["email"], $_POST["pass"], $_POST["nickname"]) &&
        !empty($_POST["email"]) && !empty($_POST["nickname"]) && !empty($_POST["pass"])
    ) {
        //le formulaire est complet
        //on recupere les données en les protégeeant 

        $pseudo = strip_tags($_POST["nickname"]);

        //on verifie si le mail est valide 
        $_SESSION["error"] = [];

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

            $_SESSION["error"][] = "le mail est incorrect";
        }
        if ($_SESSION["error"] === []) {
            //on hashe le mot de passe 
            $pass = password_hash($_POST["pass"], PASSWORD_ARGON2I);

            //  o ajoute les autres controles

            //On enregistre en bdd 

            include_once "includes/connect.php";

            $sql = "INSERT INTO `users` (`email`,`pass`,`role`) VALUES(:email,'$pass','[\"ROLE_USER\"]'  )";

            $stmt = $db->prepare($sql);

            // $stmt->bindValue(':id', $pseudo, PDO::PARAM_STR);
            $stmt->bindValue(':email', $_POST["email"], PDO::PARAM_STR);

            $stmt->execute();
            $id = $db->lastInsertId();

            // on connectera l utilisateur 



            $_SESSION["user"] = [
                "id" => $id,
                "email" => $_POST["email"],
                "role" => ["ROLE_USER"],

            ];

            header("Location: profil.php");

            //  var_dump($_POST);
        }
    } else {

        //le formulaire n' est pas complet 
        $_SESSION["error"][] = "le formulaire n' est pas complet ";
    }
}




// on ajoutes les includes
$titre = "Inscription";
// le header
include "includes/header.php";

//le navbar
include "includes/navbar.php";
?>
<p>Formulaire d'inscription</p>

<?php
if (isset($_SESSION["error"])) {
    foreach ($_SESSION["error"] as $message) {

        echo $message;
    }
    unset($_SESSION["error"]);
}

?>


<form method="post" action="">
    <div>
        <label for="pseudo"></label>
        <input type="text" name="nickname" id="pseudo">
    </div>
    <div>
        <label for="email"></label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass"></label>
        <input type="text" name="pass" id="pass">
    </div>
    <div>
        <button type="submit">S'inscrire </button>
    </div>

</form>

<?php




//le footer
include "includes/footer.php";

?>