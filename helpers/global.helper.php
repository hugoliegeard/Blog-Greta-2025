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
