<?php

define("BASE_DIR", dirname(__DIR__));
const UPLOAD_DIR = BASE_DIR . DIRECTORY_SEPARATOR . 'uploads';

function uploadFile(array $file,
                     string $title = null,
                     string $folder = '/',
                     array  $mimeTypes = ['image/jpeg', 'image/gif', 'image/svg', 'image/png']): string {

    # Vérification du mimeType
    if (!in_array($file['type'], $mimeTypes)) {
        return false;
    }

    # Récupération du fichier temporaire
    $tmpName = $file['tmp_name'];

    # Récupération de l'extension du fichier
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = pathinfo($file['name'], PATHINFO_FILENAME);

    # Génération du nom de fichier
    $filename = $title ?? $filename;
    $filename = slugify($filename) . '.' . $extension;

    $destination = UPLOAD_DIR . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;

    # Création du dossier s'il n'existe pas
    if (!is_dir($destination)) {
        mkdir($destination, 0777, true);
    }

    $fileDestination = $destination . $filename;

    if (!move_uploaded_file($file['tmp_name'], $fileDestination)) {
        return false;
    }

    return $filename;
}