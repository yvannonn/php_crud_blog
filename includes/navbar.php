<nav>
    <ul>
        <li>Accueil</li>
        <li>Liste Aricles </li>

        <?php if (!isset($_SESSION["user"])) : ?>
            <li> <a href="../tuto1reprise/inscription.php">Inscription</a></li>

            <li> <a href="../tuto1reprise/connexion.php">Connexion </a></li>

        <?php else : ?>

            <li> <a href="../tuto1reprise/deconnexion.php">deconnexion</a></li>

        <?php endif ?>

    </ul>
</nav>