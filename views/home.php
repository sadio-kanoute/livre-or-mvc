<h2>Bienvenue sur notre site</h2>
<p>Ce site vous permet de partager vos impressions et de lire celles des autres visiteurs.</p>

<div class="welcome-content">
    <div class="feature">
        <h3>📝 Partagez vos avis</h3>
        <p>Inscrivez-vous et laissez vos commentaires dans notre livre d'or.</p>
    </div>
    
    <div class="feature">
        <h3>👥 Communauté</h3>
        <p>Découvrez ce que pensent les autres visiteurs de notre site.</p>
    </div>
    
    <div class="feature">
        <h3>🔐 Sécurisé</h3>
        <p>Vos données sont protégées et votre profil est sécurisé.</p>
    </div>
</div>

<div class="cta">
    <?php if (!isLoggedIn()): ?>
        <a href="inscription.php" class="btn btn-primary">Rejoindre la communauté</a>
        <a href="livre-or.php" class="btn btn-secondary">Voir le livre d'or</a>
    <?php else: ?>
        <p>Bonjour <strong><?php echo escape($_SESSION['login']); ?></strong> !</p>
        <a href="livre-or.php" class="btn btn-primary">Voir le livre d'or</a>
        <a href="commentaire.php" class="btn btn-secondary">Ajouter un commentaire</a>
    <?php endif; ?>
</div>