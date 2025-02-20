<?php

# Inclusion du header
require_once 'partials/header.php';

# Déconnexion de l'utilisateur
logout();

# Redirection vers la page d'accueil
redirect('index.php');

