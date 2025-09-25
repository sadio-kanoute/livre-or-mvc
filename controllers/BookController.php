<?php
/**
 * CONTROLLER - Livre d'Or
 * Gestion de l'affichage et ajout des commentaires
 */

function livreOrController() {
    try {
        $commentaires = getAllComments();
        
        // Préparer les données pour la vue
        $data = [
            'title' => 'Livre d\'Or',
            'activePage' => 'livre-or',
            'commentaires' => $commentaires,
            'error' => ''
        ];
        
    } catch (Exception $e) {
        $data = [
            'title' => 'Livre d\'Or',
            'activePage' => 'livre-or',
            'commentaires' => [],
            'error' => 'Erreur lors de la récupération des commentaires.'
        ];
    }
    
    // Charger la vue
    loadView('livre-or', $data);
}

function addCommentController() {
    $error = '';
    $success = '';
    
    // Vérifier si l'utilisateur est connecté
    if (!isLoggedIn()) {
        redirect('connexion.php');
    }
    
    // Traitement du formulaire d'ajout de commentaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $commentaire = trim($_POST['commentaire'] ?? '');
        
        if (empty($commentaire)) {
            $error = "Le commentaire ne peut pas être vide.";
        } elseif (strlen($commentaire) < 10) {
            $error = "Le commentaire doit contenir au moins 10 caractères.";
        } else {
            try {
                if (addComment($_SESSION['user_id'], $commentaire)) {
                    $success = "Votre commentaire a été ajouté avec succès !";
                    header("refresh:2;url=livre-or.php");
                } else {
                    $error = "Erreur lors de l'ajout du commentaire.";
                }
            } catch (Exception $e) {
                $error = "Erreur lors de l'ajout du commentaire.";
            }
        }
    }
    
    // Préparer les données pour la vue
    $data = [
        'title' => 'Ajouter un commentaire - Livre d\'Or',
        'activePage' => 'commentaire',
        'error' => $error,
        'success' => $success,
        'formData' => $_POST ?? []
    ];
    
    // Charger la vue
    loadView('add-comment', $data);
}
?>