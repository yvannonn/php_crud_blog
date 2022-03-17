<?php
//on demarre donc une session 
session_start();
//inserer les includes
include_once "includes/header.php";
include_once "includes/navbar.php";

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    //on a pas le id 
    header("location:articles.php");
    exit;
}

// on recupere le id 

$id = $_GET["id"];

include_once "includes/connect.php";
//

$sql = "SELECT * FROM article WHERE `id` =:id";


$requete = $db->prepare($sql);

$requete->bindValue(':id', $id, PDO::PARAM_INT);

$requete->execute();

$article = $requete->fetch();

if (!$article) {
    http_response_code(404);

    echo "article inexistant";
    exit;
}

?>
<section>
    <article>
        <h1><a><?= strip_tags($article["titre"]) ?>
            </a></h1>

        <p>
            <?= $article["contenu"] ?>
        </p>
        <div>
            <?= $article["created_at"] ?>
        </div>
    </article>
</section>

<?php



include_once "includes/footer.php";
