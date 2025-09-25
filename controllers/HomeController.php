<?php
/**
 * CONTROLLER - Home
 * Gestion de la page d'accueil
 */

function homeController() {
    // Gestion de la déconnexion
    if (isset($_GET['logout'])) {
        session_destroy();
        redirect('index.php');
    }
    
    // Préparer les données pour la vue
    $data = [
        'title' => 'Livre d\'Or - Accueil',
        'activePage' => 'accueil'
    ];
    
    // Charger la vue
    loadView('home', $data);
}
?>