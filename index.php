<?php
require_once 'config.php';
require_once 'includes/functions.php';

// Charger les models
loadModels();

// Charger le contrôleur Home
loadController('HomeController');

// Appeler le contrôleur
homeController();
?>
