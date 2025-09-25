<?php
/**
 * Fonctions communes pour le livre d'or MVC Procédural
 */

// Fonction de connexion à la base de données
function getConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, 
                DB_USER, 
                DB_PASS, 
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            // Affichage d'erreur avec info environnement pour debug
            $error = 'Erreur de connexion à la base de données (' . ENVIRONMENT . '): ' . $e->getMessage();
            $error .= '<br>Host: ' . DB_HOST . ' | DB: ' . DB_NAME . ' | User: ' . DB_USER;
            die($error);
        }
    }
    
    return $pdo;
}

// Fonction pour vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['login']);
}

// Fonction pour rediriger vers une autre page
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

// Fonction pour échapper et afficher du HTML
function escape($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}

// Fonction pour valider un login
function validateLogin($login) {
    return !empty(trim($login)) && strlen(trim($login)) >= 3;
}

// Fonction pour valider un mot de passe
function validatePassword($password) {
    return !empty($password) && strlen($password) >= 4;
}

// Fonction pour charger une vue avec un layout
function loadView($viewName, $data = []) {
    // Capturer le contenu de la vue
    ob_start();
    include __DIR__ . '/../views/' . $viewName . '.php';
    $content = ob_get_clean();
    
    // Charger le layout avec le contenu
    include __DIR__ . '/../views/layouts/main.php';
}

// Fonction pour inclure les models nécessaires
function loadModels() {
    require_once __DIR__ . '/../models/UserModel.php';
    require_once __DIR__ . '/../models/CommentModel.php';
}

// Fonction pour inclure un contrôleur
function loadController($controllerName) {
    $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    } else {
        die('Contrôleur non trouvé : ' . $controllerName);
    }
}
?>