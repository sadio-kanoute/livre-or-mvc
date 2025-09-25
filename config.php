<?php
/**
 * Configuration du Livre d'Or MVC Procédural
 * Détection automatique : Localhost vs Plesk
 */

// Détection automatique de l'environnement
function isLocalhost() {
    $localhost_ips = ['127.0.0.1', '::1', 'localhost'];
    return in_array($_SERVER['SERVER_NAME'] ?? $_SERVER['HTTP_HOST'] ?? '', $localhost_ips) 
           || strpos($_SERVER['HTTP_HOST'] ?? '', 'localhost') !== false;
}

// Configuration selon l'environnement
if (isLocalhost()) {
    // === CONFIGURATION LOCALHOST (WAMP/XAMPP) ===
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'livreor');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('ENVIRONMENT', 'LOCAL');
    
    // Mode développement : afficher les erreurs
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
} else {
    // === CONFIGURATION PLESK (PRODUCTION) ===
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'sadio-kanoute_livreor');  
    define('DB_USER', 'sadio-livreor');          
    define('DB_PASS', 'Adama@1974@');   
    define('ENVIRONMENT', 'PLESK');
    
    // Mode production : masquer les erreurs
    ini_set('display_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE);
}

// Configuration commune
define('DB_CHARSET', 'utf8mb4');
define('APP_NAME', 'Livre d\'Or');
define('APP_VERSION', '1.0.0');
define('SESSION_TIMEOUT', 3600); // 1 heure


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>