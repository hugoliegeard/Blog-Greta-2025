<?php

# Démarrage de la session
session_start();

# Importation du fichier de configuration
require_once 'config/config.php';

# Importation de la connexion à la BDD
require_once 'config/database.php';

# Importation des Helpers
require_once 'helpers/global.helper.php';
require_once 'helpers/category.helper.php';
require_once 'helpers/post.helper.php';
require_once 'helpers/author.helper.php';
require_once 'helpers/user.helper.php';
require_once 'helpers/security.helper.php';
require_once 'helpers/upload.helper.php';

# Récupération des catégories
$categories = getCategories();
# var_dump($categories);

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actu360&deg;</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- En-tête -->
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="accueil">Actu360&deg;</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
        </div>
    </nav>
</header>