<?php
if (isset($_SESSION["user"])) {

    header("Location: profil.php");
    exit;
}

//on demarre donc une session 
session_start();

//on vérifie si le formulaire est envoyé 

if (!empty($_POST)) {

    //le formulaire est envoyé
    //on vérifie si tous les champs sont complets

    if (
        isset($_POST["email"], $_POST["pass"]) &&
        !empty($_POST["email"]) && !empty($_POST["pass"])
    ) {

        //le formulaire est complet 

        //on verifie que le mail en est un
        $_SESSION["error"] = [];

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

            $_SESSION["error"] = "email incorrect";
        }

        if ($_SESSION["error"] === 0) {

            // on se connete donc à ma bd
            include "includes/connect.php";



            $sql = " SELECT * FROM users where email=:email";

            $requete = $db->prepare($sql);

            $requete->bindValue(':email', $_POST["email"], PDO::PARAM_STR);

            $requete->execute();

            $user = $requete->fetch();


            if (!$user) {

                $_SESSION["error"] = "utilisateur et/mot de passe incorrect";
            }

            //on peut verifier si le mot de ;passe est correct 
            //  var_dump($_POST["pass"]);
            //  var_dump(password_verify($_POST["pass"], $user["pass"]));

            if (!password_verify($_POST["pass"], $user["pass"])) {
                $_SESSION["error"] = "utilisateur et/mot de passe incorrect";
            }



            $_SESSION["user"] = [
                "id" => $user["id"],
                "email" => $user["email"],
                "role" => $user["role"],

            ];
            //on redireige vers la page rofil
            header("location: profil.php");
        }
    } else {
        // le formulaire n' est pas complet 

        $_SESSION["error"][] = "le formulaire n' est pas complet";
    }
}




$titre = "Connexion 2.0";
include_once "includes/header.php";

include_once "includes/navbar.php";



?>
<p>Formulaire de connexion</p>

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
        <label for="email"></label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass"></label>
        <input type="text" name="pass" id="pass">
    </div>
    <div>
        <button type="submit">se connecter </button>
    </div>

</form>

<?php


include "includes/footer.php";
