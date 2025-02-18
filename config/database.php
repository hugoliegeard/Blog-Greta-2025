<?php

# Documentation PDO : https://www.php.net/manual/fr/pdo.connections.php

try {
    # Création de la connexion à la base de données
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);

    # Option I : Permet de demander à PDO de retourner les erreurs SQL
    # ⚠️⚠️⚠️ À DÉSACTIVER EN PRODUCTION ⚠️⚠️⚠️⚠
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    # Option II : Permet de demander à PDO de retourner les résultats sous forme de tableaux associatifs
    # cf. https://www.php.net/manual/fr/pdostatement.fetch.php
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    # En cas d'erreur, celle-ci est capturé par le catch et un message d'erreur est affiché
    echo 'Erreur de connexion : ' . $e->getMessage();

    # Arrêt du script
    die;
}
