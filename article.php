<?php
# Inclusion du header
require_once 'partials/header.php';

/*
 * Récupération du slug de l'article depuis l'URL
 * Ex: article.php?slug=titre-1
 */

// Récupération de l'article par son slug
$post = getPostBySlug($_GET['slug']);
if (!$post) {
    redirect('404.php');
}

?>

    <main>
        <div class="container py-5">
            <!-- En-tête de l'article -->
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4"><?= $post['title'] ?></h1>
                    <div class="text-muted mb-4">
                        <small class="text-muted">Rédigé par <a href="auteur.php?username=<?= $post['username'] ?>"><?= $post['username'] ?></a> - le <?= date('d/m/Y à H:i', strtotime($post['createdAt'])) ?></small>
                    </div>
                </div>
            </div>

            <!-- Affichage des messages flash -->
            <?php include 'partials/flash/_flash.message.php' ?>

            <!-- Contenu de l'article -->
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <!-- Image principale -->
                    <img src="<?= 'uploads/posts/'.$post['image'] ?>"
                         alt="<?= $post['title'] ?>" class="img-fluid mb-4 rounded">

                    <!-- Corps de l'article -->
                    <div class="article-content">
                        <p><?= $post['content'] ?></p>
                    </div>

                    <!-- Navigation entre articles -->
                    <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                        <a href="#" class="btn btn-outline-primary">&larr; Article précédent</a>
                        <a href="#" class="btn btn-outline-primary">Article suivant &rarr;</a>
                    </div>

                </div>
            </div>
        </div>
    </main>

<?php
# Inclusion du footer
require_once 'partials/footer.php';
?>