<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape($data['title']); ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <nav>
            <h1>Mon Livre d'Or</h1>
            <ul>
                <li><a href="index.php" <?php echo ($data['activePage'] ?? '') === 'accueil' ? 'class="active"' : ''; ?>>Accueil</a></li>
                <li><a href="livre-or.php" <?php echo ($data['activePage'] ?? '') === 'livre-or' ? 'class="active"' : ''; ?>>Livre d'Or</a></li>
                <?php if (isLoggedIn()): ?>
                    <li><a href="profil.php" <?php echo ($data['activePage'] ?? '') === 'profil' ? 'class="active"' : ''; ?>>Mon Profil</a></li>
                    <li><a href="index.php?logout=1">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="inscription.php" <?php echo ($data['activePage'] ?? '') === 'inscription' ? 'class="active"' : ''; ?>>Inscription</a></li>
                    <li><a href="connexion.php" <?php echo ($data['activePage'] ?? '') === 'connexion' ? 'class="active"' : ''; ?>>Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <?php echo $content; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Mon Livre d'Or - 
        <a href="https://github.com/votre-nom/livre-or" target="_blank">Voir sur GitHub</a></p>
    </footer>
</body>
</html>