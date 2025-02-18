<?php

function getCategories(): array {
    # Récupération de ma variable $dbh définie dans config/database.php
    global $dbh;

    # Requête SQL pour récupérer toutes les catégories
    $query = $dbh->query('SELECT * FROM category');

    # Retourner les résultats de la requête
    return $query->fetchAll();
}

/**
 * Récupérer une catégorie par son slug
 * @param string $slug
 * @return array
 */
function getCategoryBySlug(string $slug): array {
    global $dbh;
    $sql = 'SELECT * FROM category c WHERE c.slug = :slug';

    # Préparation de ma requête
    # ⚠️⚠️ Paramètre externe = requête préparée ⚠️⚠️
    $query = $dbh->prepare($sql);

    # J'associe les valeurs aux paramètres de ma requête préparée
    # NOTA BENE : Cette préparation me protège contre les injections SQL.
    $query->bindValue(':slug', $slug, PDO::PARAM_STR);

    # Exécution de la requête
    $query->execute();

    # Retourner les résultats de la requête
    return $query->fetch();
}
