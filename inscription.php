<?php

# Inclusion du header
require_once 'partials/header.php';

# Initialisation des variables
$firstname = $lastname = $username = $email = $password = null;

# $_POST ne peut pas être vide quand l'utilisateur a soumis les données de son formulaire.
if (!empty($_POST)) {

    # Je commence ma validation de formulaire
    $firstname = $_POST['firstname']; # Contient la valeur du champ prénom
    $lastname = $_POST['lastname']; # Contient la valeur du champ nom
    $username = $_POST['username']; # Contient la valeur du champ nom d'utilisateur
    $email = $_POST['email']; # Contient la valeur du champ email
    $password = $_POST['password']; # Contient la valeur du champ mot de passe

    # Vérification des informations saisies
    # Déclarer un tableau d'erreurs
    $errors = [];

    # Vérification du prénom
    if (empty($firstname)) {
        $errors['firstname'] = 'Le prénom est obligatoire';
    }

    # Vérification du nom
    if (empty($lastname)) {
        $errors['lastname'] = 'Le nom est obligatoire';
    }

    # Vérification du nom d'utilisateur
    if (empty($username)) {
        $errors['username'] = 'Le nom d\'utilisateur est obligatoire';
    }

    # Vérification de l'adresse email
    if (empty($email)) {
        $errors['email'] = 'L\'adresse email est obligatoire';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'L\'adresse email n\'est pas valide';
    }

    # Vérification du mot de passe
    if (empty($password)) {
        $errors['password'] = 'Le mot de passe est obligatoire';
    } elseif (strlen($password) < 12) {
        $errors['password'] = 'Le mot de passe doit contenir au moins 12 caractères';
    }

    # Si le tableau d'erreurs est vide, alors il n'y a pas d'erreurs
    if (empty($errors)) {

        // $idUser = insertUser($firstname, $lastname, $username, $email, $password);
        $idUser = insertUser(...$_POST);
        if ($idUser) {
            // Rediriger l'utilisateur vers la page de connexion
            redirect('connexion.php');
        }

    }

}

?>

    <main>
        <div class="p-5 mx-auto text-center">
            <h1 class="display-4">Inscription</h1>
        </div>
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-8 mx-auto">
                        <form novalidate id="register" method="POST" action="inscription.php">

                            <!-- Affichage d'une notification d'erreur -->
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger mt-4">
                                    <p><u>Une erreur est survenue dans la validation de vos données : </u></p>
                                    <?php foreach ($errors as $error) : ?>
                                        - <?= $error ?> <br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif ?>

                            <!-- Prénom -->
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control <?= isset($errors['firstname']) ? 'is-invalid' : '' ?>"
                                       placeholder="Saisissez votre prénom" value="<?= $firstname ?>"
                                       id="firstname" name="firstname" required>
                                <div class="invalid-feedback">
                                    <?= $errors['firstname'] ?>
                                </div>
                            </div>

                            <!-- Nom -->
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Nom</label>
                                <input type="text" class="form-control <?= isset($errors['lastname']) ? 'is-invalid' : '' ?>"
                                       placeholder="Saisissez votre prénom" value="<?= $lastname ?>"
                                       id="lastname" name="lastname" required>
                                <div class="invalid-feedback">
                                    <?= $errors['lastname'] ?>
                                </div>
                            </div>

                            <!-- Nom d'utilisateur -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'utilisateur</label>
                                <input type="text" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                                       placeholder="Saisissez votre nom d'utilisateur" value="<?= $username ?>"
                                       id="username" name="username" required>
                                <div class="invalid-feedback">
                                    <?= $errors['username'] ?>
                                </div>
                            </div>

                            <!-- Adresse E-mail -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                       placeholder="Saisissez votre adresse email" value="<?= $email ?>"
                                       id="email" name="email" required>
                                <div class="invalid-feedback">
                                    <?= $errors['email'] ?>
                                </div>
                            </div>

                            <!-- Mot de passe -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                       placeholder="Saisissez votre mot de passe" value="<?= $password ?>"
                                       id="password" name="password" required>
                                <div class="invalid-feedback">
                                    <?= $errors['password'] ?>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-dark">M'inscrire</button>
                            </div>

                        </form>
                    </div>  <!-- /.col-8 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.bg-light -->
    </main>

<?php require_once 'partials/footer.php'; ?>