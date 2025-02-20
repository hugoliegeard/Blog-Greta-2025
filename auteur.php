<?php

# Inclusion du header
require_once 'partials/header.php';

# Récupération de l'auteur
$author = getAuthorByUsername($_GET['username']);

# Récupération des articles de l'auteur
$posts = getPostsByAuthorId($author['id_user']);

?>


<main>
    <div class="p-5 mx-auto text-center">
        <h1 class="mb-4 display-4">
            Les articles écrit par : <?= $author['username'] ?>
        </h1>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">

                <?php foreach ($posts as $post) : ?>
                    <div class="mb-4 col-md-4 col-sm-6">
                        <div class="card shadow-sm">
                            <img src="https://fakeimg.pl/600x350/?text=<?= $post['image'] ?>" alt="Miniature de l'article <?= $post['title'] ?>" class="img-fluid">
                            <div class="card-body">
                                <h5 class="card-title"><?= $post['title'] ?></h5>
                                <small class="text-muted">Rédigé par <a href="auteur.php?username=<?= $post['username'] ?>"><?= $post['username'] ?></a> - le <?= date('d/m/Y à H:i', strtotime($post['createdAt'])) ?></small>
                                <br>
                                <small class="text-muted">Dans la catégorie : <?= $post['category'] ?></small>
                                <p class="card-text"><?= mb_strimwidth($post['content'], 0, 20) ?>...</p>
                                <a href="<?= $post['id_post'] ?>_<?= $post['slug'] ?>" class="btn btn-primary">Lire la suite</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.bg-light -->

</main>

<?php require_once 'partials/footer.php'; ?>
