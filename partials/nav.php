<div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav text-center mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page"
               href="accueil">Accueil</a>
        </li>
        <?php foreach ($categories as $category) : ?>
            <li class="nav-item">
                <a class="nav-link"
                   href="<?= $category['slug'] ?>">
                    <?= $category['name'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="text-right">
        <?php if (isLogged()) : ?>

            <span class="navbar-text mx-2">
                            Bonjour <strong><?= $_SESSION['user']['firstname'] ?></strong>
                                <em>( <?= $_SESSION['user']['roles'] ?> )</em>

                        </span>

            <?php if (isGranted('ROLE_AUTHOR')) : ?>
                <a class="nav-item btn btn-outline-warning"
                   href="creer-un-article.php">Créer un article</a>
            <?php endif ?>

            <a class="nav-item btn btn-outline-danger"
               href="deconnexion.html">Déconnexion</a>

        <?php else : ?>
            <a class="nav-item btn btn-outline-info" href="connexion.html">Connexion</a>
            <a class="nav-item btn btn-outline-warning" href="inscription.html">Inscription</a>
        <?php endif; ?>
    </div>
</div>