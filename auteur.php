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
                <?php foreach ($posts as $post): include 'partials/post/_post-card.php'; endforeach; ?>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.bg-light -->

</main>

<?php require_once 'partials/footer.php'; ?>
