<?php

/**
 * Inserts a new user into the database with the provided details.
 *
 * @param string $firstname The first name of the user.
 * @param string $lastname The last name of the user.
 * @param string $username The last name of the user.
 * @param string $email The email address of the user.
 * @param string $password The password of the user.
 * @param string $roles
 * @return bool|int This method does not return a value.
 */
function insertUser(string $firstname,
                    string $lastname,
                    string $username,
                    string $email,
                    string $password,
                    string $roles = 'ROLE_USER'): bool|int {
    global $dbh;
    $sql = 'INSERT INTO user (email, password, firstname, lastname, username, roles, createdAt, updatedAt) 
                VALUES (:email, :password, :firstname, :lastname, :username, :roles,  NOW(), NOW())';

    $query = $dbh->prepare($sql);

    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->bindValue(':roles', $roles);

    return $query->execute() ? $dbh->lastInsertId() : false;
}

/**
 * Retrieves a user record from the database using the provided email address.
 *
 * @param string $email The email address of the user to retrieve.
 * @return array The user record as an associative array, or an empty array if no user is found.
 */
function getUserByEmail(string $email): array {
    global $dbh;
    $sql = 'SELECT * FROM user WHERE email = :email';
    $query = $dbh->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}
