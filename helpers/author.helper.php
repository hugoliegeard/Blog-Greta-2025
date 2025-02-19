<?php

/**
 * Récupère un auteur par son username
 * @param string $username
 * @return array
 */
function getAuthorByUsername(string $username): array {
    global $dbh;

    $sql = 'SELECT * FROM user u WHERE u.username = :username';
    $query = $dbh->prepare($sql);

    $query->bindValue(':username', $username,PDO::PARAM_STR);
    $query->execute();

    return $query->fetch();
}
