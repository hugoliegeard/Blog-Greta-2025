<?php

function getPosts(): array
{
    // Récupération de ma variable $dbh définie dans config/database.php
    global $dbh;

    // Requête SQL pour récupérer toutes les catégories
    $query = $dbh->query('SELECT
                                    post.*,
                                    user.username
                                    FROM post
                                    INNER JOIN user ON post.id_user = user.id_user
                                    ORDER BY createdAt DESC');

    // Retourner les résultats de la requête
    return $query->fetchAll();
}

function getPostsByCategoryId(int $id_category): array
{
    global $dbh;

    $sql = 'SELECT p.*, u.username FROM post p 
               INNER JOIN user u ON p.id_user = u.id_user
                WHERE p.id_category = :id_category
                    ORDER BY p.createdAt DESC';

    $query = $dbh->prepare($sql);
    $query->bindValue(':id_category', $id_category, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll();

}

/**
 * Permet de récupérer un article par son slug
 * @param string $slug
 * @return array|bool
 */
function getPostBySlug(string $slug): array|bool
{
    global $dbh;

    $sql = 'SELECT p.*, u.username FROM post p 
               INNER JOIN user u ON p.id_user = u.id_user
                WHERE p.slug = :slug';

    $query = $dbh->prepare($sql);
    $query->bindValue(':slug', $slug, PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}

function getPostsByAuthorId(int $idAuthor): array
{
    global $dbh;

    $query = $dbh->prepare('SELECT post.*, user.username, category.name as category
                                    FROM post
                                        INNER JOIN category ON post.id_category = category.id_category
                                        INNER JOIN user ON post.id_user = user.id_user
                                    WHERE user.id_user = :id
                                    ORDER BY createdAt DESC');

    $query->bindValue(':id', $idAuthor, PDO::PARAM_INT);
    $query->execute();

    # Je retourne le résultat de ma requête
    return $query->fetchAll();

}

function createPost(string $title, string $slug, string $content, string $image, int $id_category, int $id_user): bool
{
    global $dbh;

    $sql = 'INSERT INTO post (title, slug, content, image, id_category, id_user, createdAt, updatedAt)
                VALUES (:title, :slug, :content, :image, :id_category, :id_user, NOW(), NOW())';

    $query = $dbh->prepare($sql);
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':slug', $slug, PDO::PARAM_STR);
    $query->bindValue(':content', $content, PDO::PARAM_STR);
    $query->bindValue(':image', $image, PDO::PARAM_STR);
    $query->bindValue(':id_category', $id_category, PDO::PARAM_INT);
    $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);

    return $query->execute() ? $dbh->lastInsertId() : false;
}
