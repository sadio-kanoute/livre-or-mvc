<?php
/**
 * CONTROLLER - Auth
 * Gestion de l'authentification (inscription/connexion)
 */

function registerController() {
    $error = '';
    $success = '';
    
    // Redirection si déjà connecté
    if (isLoggedIn()) {
        redirect('livre-or.php');
    }
    
    // Traitement du formulaire d'inscription
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        
        // Validation des données
        if (empty($login) || empty($password) || empty($confirmPassword)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!validateLogin($login)) {
            $error = "Le login doit contenir au moins 3 caractères.";
        } elseif (!validatePassword($password)) {
            $error = "Le mot de passe doit contenir au moins 4 caractères.";
        } elseif ($password !== $confirmPassword) {
            $error = "Les mots de passe ne correspondent pas.";
        } elseif (loginExists($login)) {
            $error = "Ce login est déjà utilisé.";
        } else {
            // Créer l'utilisateur
            if (createUser($login, $password)) {
                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header("refresh:2;url=connexion.php");
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        }
    }
    
    // Préparer les données pour la vue
    $data = [
        'title' => 'Inscription - Livre d\'Or',
        'activePage' => 'inscription',
        'error' => $error,
        'success' => $success,
        'formData' => $_POST ?? []
    ];
    
    // Charger la vue
    loadView('register', $data);
}

function loginController() {
    $error = '';
    
    // Redirection si déjà connecté
    if (isLoggedIn()) {
        redirect('livre-or.php');
    }
    
    // Traitement du formulaire de connexion
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($login) || empty($password)) {
            $error = "Veuillez remplir tous les champs.";
        } else {
            $user = authenticateUser($login, $password);
            
            if ($user) {
                // Connexion réussie
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['login'] = $user['login'];
                redirect('livre-or.php');
            } else {
                $error = "Login ou mot de passe incorrect.";
            }
        }
    }
    
    // Préparer les données pour la vue
    $data = [
        'title' => 'Connexion - Livre d\'Or',
        'activePage' => 'connexion',
        'error' => $error,
        'formData' => $_POST ?? []
    ];
    
    // Charger la vue
    loadView('login', $data);
}
?>