<?php
    # Inclusion du header
    require_once 'partials/header.php';

    # Vérification du droit d'accès
    if (!isGranted('ROLE_AUTHOR')) {
        addFlash('danger', 'Vous devez être connecté pour accéder à cette page.');
        redirect('connexion.html');
    }

    # Initialisation des variables
    $title = $slug = $content = $image = null;

    # Vérification des données POST
    if (!empty($_POST)) {

        # Récupération des données
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $content = $_POST['content'];
        $image = $_FILES['image'];
        $id_category = $_POST['id_category'] ?? null;

        # Initialisation du tableau d'erreurs
        $errors = [];

        # Validation des données
        if (empty($title)) {
            $errors['title'] = "Le titre est obligatoire";
        }

        if (empty($slug)) {
            # TODO Générer un alias à partir du titre
            if (!empty($title)) {
                $slug = slugify($title);
            }
            // $errors['slug'] = "L'alias est obligatoire"; -- Plus besoin
        }

        if (empty($content)) {
            $errors['content'] = "Le contenu est obligatoire";
        }

        if (empty($id_category)) {
            $errors['id_category'] = "La catégorie est obligatoire";
        }

        if (empty($image['size'])) {
            $errors['image'] = "L'image est obligatoire";
        }

        # Téléchargement de l'image
        $image = uploadFile($image, $title, 'posts');

        # Si aucune erreur
        if (empty($errors)) {
            # Insertion de l'article
            $postId = createPost($title, $slug, $content, $image, $id_category, $_SESSION['user']['id_user']);

            # Si l'article est inséré
            if ($postId) {
                # Redirection vers la page d'accueil
                addFlash('success', 'Votre article a bien été publié.');
                redirect($postId.'_'.$slug);
            }
        }
    }

?>

    <main>
        <div class="p-5 mx-auto text-center">
            <h1 class="display-4">Rédiger un article</h1>
        </div>
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-8 mx-auto">

                        <!--
                            enctype="multipart/form-data" : OBLIGATOIRE, il permet de transférer
                            des données multimédia via votre formulaire. Ex. PDF, IMAGES, VIDEOS, ...
                        -->

                        <form enctype="multipart/form-data" novalidate id="createPost" method="POST">

                            <!-- Affichage d'une notification d'erreur -->
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger mt-4">
                                    <p><u>Une erreur est survenue dans la validation de vos données : </u></p>
                                    <?php foreach ($errors as $error) : ?>
                                        - <?= $error ?> <br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif ?>

                            <!-- Titre -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text"
                                       class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>"
                                       placeholder="-- Titre de l'article --" value="<?= $title ?>"
                                       id="title" name="title" required>
                                <div class="invalid-feedback">
                                    <?= $errors['title'] ?>
                                </div>
                            </div>

                            <!-- Alias -->
                            <div class="mb-3">
                                <label for="slug" class="form-label">Alias</label>
                                <input type="text"
                                       class="form-control <?= isset($errors['slug']) ? 'is-invalid' : '' ?>"
                                       placeholder="-- Alias de l'article --" value="<?= $slug ?>"
                                       id="slug" name="slug" required>
                                <div class="invalid-feedback">
                                    <?= $errors['slug'] ?>
                                </div>
                            </div>

                            <!-- Categorie -->
                            <div class="mb-3">
                                <label for="id_category" class="form-label">Catégorie</label>
                                <select class="form-select <?= isset($errors['id_category']) ? 'is-invalid' : '' ?>" name="id_category" id="id_category">
                                    <option selected disabled>-- Choisissez une catégorie --</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id_category'] ?>">
                                            <?= $category['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= $errors['id_category'] ?>
                                </div>
                            </div>

                            <!-- Contenu -->
                            <div class="mb-3">
                                <label for="content" class="form-label">Contenu</label>
                                <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>"
                                          placeholder="Saisissez votre article" value="<?= $content ?>"
                                          id="content" name="content" required></textarea>
                                <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                                <script>
                                    CKEDITOR.replace( 'content' );
                                </script>
                                <div class="invalid-feedback">
                                    <?= $errors['content'] ?>
                                </div>
                            </div>

                            <!-- Image d'illustration -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>"
                                       id="image" name="image" placeholder="Choisissez votre image">

                                    <div class="invalid-feedback">
                                        <?= $errors['image'] ?>
                                    </div>

                                <div id="imageHelp" class="form-text">
                                    Seul les formats .jpg, .jpeg, .gif et .png sont autorisés jusqu'à une taille de maximal
                                    de 5Mo
                                </div>

                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-dark">Publier mon article</button>
                            </div>

                        </form>
                    </div>  <!-- /.col-8 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.bg-light -->
    </main>

<script src="assets/js/creer-un-article.js"></script>

<?php require_once 'partials/footer.php'; ?>