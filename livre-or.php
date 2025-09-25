<?php
require_once 'config.php';
require_once 'includes/functions.php';

// Charger les models
loadModels();

// Charger le contrôleur Book
loadController('BookController');

// Appeler le contrôleur
livreOrController();
?>