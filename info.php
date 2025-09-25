<?php
require_once 'config.php';
require_once 'includes/functions.php';

// Page d'information sur l'environnement (à supprimer en production)
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Environnement - Livre d'Or</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .env-local { background: #e7f5e7; border-left: 5px solid #28a745; padding: 15px; }
        .env-plesk { background: #fff3cd; border-left: 5px solid #ffc107; padding: 15px; }
        .info { background: #f8f9fa; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { color: #28a745; } .error { color: #dc3545; }
        pre { background: #f1f1f1; padding: 10px; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>🔧 Information Environnement - Livre d'Or</h1>

    <div class="<?php echo ENVIRONMENT === 'LOCAL' ? 'env-local' : 'env-plesk'; ?>">
        <h2>📍 Environnement détecté : <?php echo ENVIRONMENT; ?></h2>
        <p><strong>Host:</strong> <?php echo $_SERVER['HTTP_HOST'] ?? 'N/A'; ?></p>
        <p><strong>Server Name:</strong> <?php echo $_SERVER['SERVER_NAME'] ?? 'N/A'; ?></p>
    </div>

    <div class="info">
        <h3>🗄️ Configuration Base de Données</h3>
        <pre>Host: <?php echo DB_HOST; ?>
Database: <?php echo DB_NAME; ?>
User: <?php echo DB_USER; ?>
Charset: <?php echo DB_CHARSET; ?></pre>
    </div>

    <div class="info">
        <h3>🔌 Test de Connexion</h3>
        <?php
        try {
            $pdo = getConnection();
            echo '<p class="success">✅ Connexion à la base de données réussie !</p>';
            
            // Test des tables
            $stmt = $pdo->query("SHOW TABLES");
            $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            if (in_array('utilisateurs', $tables) && in_array('commentaires', $tables)) {
                echo '<p class="success">✅ Tables utilisateurs et commentaires trouvées !</p>';
            } else {
                echo '<p class="error">❌ Tables manquantes. Tables trouvées: ' . implode(', ', $tables) . '</p>';
            }
            
        } catch (Exception $e) {
            echo '<p class="error">❌ Erreur de connexion: ' . $e->getMessage() . '</p>';
        }
        ?>
    </div>

    <div class="info">
        <h3>⚙️ Configuration PHP</h3>
        <pre>Display Errors: <?php echo ini_get('display_errors') ? 'ON' : 'OFF'; ?>
Error Reporting: <?php echo error_reporting(); ?>
PHP Version: <?php echo phpversion(); ?></pre>
    </div>

    <div class="info">
        <h3>🚀 Actions</h3>
        <p><a href="index.php" style="background: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">🏠 Aller au site</a></p>
        
        <?php if (ENVIRONMENT === 'PLESK'): ?>
        <p style="color: #dc3545;"><strong>⚠️ IMPORTANT:</strong> Modifiez le mot de passe dans config.php ligne 22, puis supprimez ce fichier info.php en production !</p>
        <?php endif; ?>
    </div>
</body>
</html>