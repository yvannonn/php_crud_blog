<?php
//on demarre donc une session 
session_start();
include_once "includes/header.php";
include_once "includes/navbar.php";

//on va chercher les articles dans la bd

include_once "includes/connect.php";


$sql = "SELECT * FROM `article`ORDER BY titre DESC";

$requete = $db->query($sql);

$articles = $requete->fetchAll();

?>

<h1>Liste de mes articles</h1>

<?php foreach ($articles as $article) : ?>

    <section>
        <article>
            <h1><a href="article.php?id=<?= $article["id"] ?>"><?= strip_tags($article["titre"]) ?>
                </a></h1>

            <p>
                <?= $article["contenu"] ?>
            </p>
            <div>
                <?= $article["created_at"] ?>
            </div>
        </article>
    </section>

<?php endforeach; ?>

<?php



include_once "includes/footer.php";
?>