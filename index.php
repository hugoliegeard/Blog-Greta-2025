<?php
# Inclusion du header
require_once 'partials/header.php';

# Chargement des articles
$posts = getPosts();
?>

    <!-- Contenu -->
    <main>
        <!-- .p-3.mx-auto.text-center>h1.display-4{Actu360} -->
        <div class="p-5 mx-auto text-center">
            <h1 class="display-4">Actu360&deg;</h1>
        </div>

        <!-- .py-5.bg-light>.container>.row>.mb-4.col-md-4*6>.card.shadow-sm>img.img-fluid+.card-body>h5.card-title{Titre $}+small.text-muted{Auteur $}+p.card-text{Contenu $}+a.btn.btn-primary{Lire la suite} -->
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php foreach ($posts as $post): include 'partials/post/_post-card.php'; endforeach; ?>
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.bg-light -->

    </main>

<?php
# Inclusion du footer
require_once 'partials/footer.php';
?>