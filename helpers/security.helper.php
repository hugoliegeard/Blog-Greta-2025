<?php

function login(string $email, string $password): bool|array {
    $user = getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        /*
         * Ici, l'utilisateur a bien été trouvé
         * dans la base de données et le mot de passe
         * fourni correspond à celui stocké.
         */
        $_SESSION['user'] = $user;
        return true;
    }

    return false;
}

function isGranted(string $role): bool {
    return isLogged() && $_SESSION['user']['roles'] === $role;
}

/**
 * Permet de vérifier si un utilisateur est connecté.
 * @return bool
 */
function isLogged(): bool {
    return isset($_SESSION['user']);
}

/**
 * Permet de déconnecter un utilisateur.
 * en supprimant la clé 'user' de la session.
 *
 * @return void
 */
function logout(): void {
    unset($_SESSION['user']);
}
