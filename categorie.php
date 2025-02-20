<?php
# Inclusion du header
require_once 'partials/header.php';

/*
 * La superglobale $_GET est un tableau associatif
 * contenant les variables passées en paramètre dans l'URL.
 * ex. categorie.php?slug=politique ou categorie.php?slug=economie
 * ----------------------------------------------------------------
 * ?param=value&param2=value2&paramX=valueX
 * Array
 *   (
 *       [param] => value
 *       [param2] => value2
 *       [paramX] => valueX
 *   )
 *
 * print_r($_GET);
 * Array
 * (
 *    [slug] => economie
 * )
 */

$category = getCategoryBySlug($_GET['slug']);
$posts = getPostsByCategoryId($category['id_category']);

?>
    <!-- Contenu -->
    <main>
        <!-- .p-3.mx-auto.text-center>h1.display-4{Actu360} -->
        <div class="p-5 mx-auto text-center">
            <h1 class="display-4">
                <?= $category['name'] ?>
            </h1>
        </div>

        <!-- .py-5.bg-light>.container>.row>.mb-4.col-md-4*6>.card.shadow-sm>img.img-fluid+.card-body>h5.card-title{Titre $}+small.text-muted{Auteur $}+p.card-text{Contenu $}+a.btn.btn-primary{Lire la suite} -->
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">

                    <?php foreach ($posts as $post): ?>
                        <div class="mb-4 col-md-4 col-sm-6">
                            <div class="card shadow-sm">
                                <img src="https://fakeimg.pl/600x350/?text=Actu360" alt="<?= $post['title'] ?>"
                                     class="img-fluid">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $post['title'] ?></h5>
                                    <small class="text-muted">Rédigé par <a href="auteur.php?username=<?= $post['username'] ?>"><?= $post['username'] ?></a> - le <?= date('d/m/Y à H:i', strtotime($post['createdAt'])) ?></small>
                                    <p class="card-text"><?= $post['content'] ?></p>
                                    <a href="<?= $post['id_post'] ?>_<?= $post['slug'] ?>" class="btn btn-primary">Lire la suite</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.bg-light -->

    </main>

<?php
# Inclusion du footer
require_once 'partials/footer.php';
?>