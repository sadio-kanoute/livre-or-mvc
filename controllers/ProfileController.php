<?php
/**
 * CONTROLLER - Profil
 * Gestion du profil utilisateur
 */

function profileController() {
    $error = '';
    $success = '';
    $userData = [];
    
    // Vérifier si l'utilisateur est connecté
    if (!isLoggedIn()) {
        redirect('connexion.php');
    }
    
    // Récupérer les données utilisateur
    try {
        $userData = getUserById($_SESSION['user_id']);
        if (!$userData) {
            $error = "Utilisateur non trouvé.";
        }
    } catch (Exception $e) {
        $error = "Erreur lors de la récupération des données.";
    }
    
    // Traitement du formulaire de modification du profil
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newLogin = trim($_POST['login'] ?? '');
        $newPassword = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        if (empty($newLogin)) {
            $error = "Le login ne peut pas être vide.";
        } elseif (!validateLogin($newLogin)) {
            $error = "Le login doit contenir au moins 3 caractères.";
        } elseif (!empty($newPassword) && !validatePassword($newPassword)) {
            $error = "Le mot de passe doit contenir au moins 4 caractères.";
        } elseif (!empty($newPassword) && $newPassword !== $confirmPassword) {
            $error = "Les mots de passe ne correspondent pas.";
        } else {
            // Vérifier si le nouveau login existe déjà
            if ($newLogin !== $userData['login'] && loginExists($newLogin, $_SESSION['user_id'])) {
                $error = "Ce login est déjà utilisé par un autre utilisateur.";
            } else {
                try {
                    // Mettre à jour les données
                    $passwordToUpdate = !empty($newPassword) ? $newPassword : null;
                    
                    if (updateUser($_SESSION['user_id'], $newLogin, $passwordToUpdate)) {
                        // Mettre à jour la session
                        $_SESSION['login'] = $newLogin;
                        $userData['login'] = $newLogin;
                        $success = "Votre profil a été mis à jour avec succès !";
                    } else {
                        $error = "Erreur lors de la mise à jour.";
                    }
                } catch (Exception $e) {
                    $error = "Erreur lors de la mise à jour.";
                }
            }
        }
    }
    
    // Préparer les données pour la vue
    $data = [
        'title' => 'Mon Profil - Livre d\'Or',
        'activePage' => 'profil',
        'error' => $error,
        'success' => $success,
        'userData' => $userData
    ];
    
    // Charger la vue
    loadView('profile', $data);
}
?>