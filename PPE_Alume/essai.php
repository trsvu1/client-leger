<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alume - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
// Démarrage de la session
session_start();

// Récupération de la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

// Template header
require_once './src/views/template/header.php';

// Routage
switch ($page) {
    case 'accueil':
        require_once './src/views/accueil.php';
        break;

    case 'connexion':
         require_once './src/views/connexion.php';
         break;  
         
    case 'inscription':
        require_once './src/views/inscription.php';
        break;
    
    default:
        require_once './src/views/accueil.php';
        break;
}

// Template footer
require_once './src/views/template/footer.php';
?>
