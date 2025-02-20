<?php

# Inclusion du header
require_once 'partials/header.php';

# Initialisation des variables
$email = $password = null;

# $_POST ne peut pas être vide quand l'utilisateur a soumis les données de son formulaire.
if (!empty($_POST)) {

    # Création de variables dynamiques
    foreach ($_POST as $key => $value) {
        /*
        * Déclaration dynamique. Permet de déclarer
        * des variables en se basant sur la valeur de la $key.
        * cf. https://www.php.net/manual/fr/language.variables.variable.php
        */
        $$key = $value;
    }

    # Vérification des informations saisies
    # Déclarer un tableau d'erreurs
    $errors = [];

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

        if (login(...$_POST)) {
            redirect('index.php');
        } else {
            $errors['email'] = 'L\'adresse email est incorrect';
            $errors['password'] = 'Le mot de passe est incorrect';
        }

    }
}

?>

    <main>
        <div class="p-5 mx-auto text-center">
            <h1 class="display-4">Connexion</h1>
        </div>
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-8 mx-auto">
                        <form id="login" method="POST" action="connexion.php">

                            <!-- Affichage d'une notification d'erreur -->
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger mt-4">
                                    <p><u>Une erreur est survenue dans la validation de vos données : </u></p>
                                    <?php foreach ($errors as $error) : ?>
                                        - <?= $error ?> <br>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif ?>

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
                                <button class="btn btn-dark">Me connecter</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php require_once 'partials/footer.php'; ?>