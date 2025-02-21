<?php

/**
 * Redirects the user to the specified URL and terminates the script execution.
 *
 * @param string $url The URL to redirect to.
 * @return void
 */
function redirect(string $url): void {
    header('Location: ' . $url);
    exit();
}

/**
 * Dumps information about a variable in a readable format.
 *
 * @param mixed $var The variable to be dumped.
 * @return void
 */
function dump($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function dd($var) {
    dump($var);
    die();
}

function summarize(string $content, int $limit = 240): string {

    # Supprimer les balises HTML
    $content = strip_tags($content);

    # Si le contenu est plus long que la limite
    if (strlen($content) > $limit) {

        # Tronquer le contenu
        $content = substr($content, 0, $limit);

        # Trouver la dernière espace
        $lastSpace = strrpos($content, ' ');

        # Supprimer le dernier mot
        $content = substr($content, 0, $lastSpace);
    }

    return $content .= '...';

}

/**
 * Adds a flash message to the session.
 *
 * @param string $type The type of the flash message (e.g., success, error, etc.).
 * @param string $message The content of the flash message.
 * @return void
 */
function addFlash(string $type, string $message): void {
    $_SESSION['flashMessages'][] = [
        'type' => $type,
        'message' => $message
    ];
}

function slugify($text, string $divider = '-'): string
{
    // replace non letter or digits by divider
    $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim
    $text = trim($text, $divider);

    // remove duplicate divider
    $text = preg_replace('~-+~', $divider, $text);

    // lowercase
    $text = strtolower($text);

    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

