<h2>Livre d'Or</h2>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-error"><?php echo escape($data['error']); ?></div>
<?php endif; ?>

<?php if (isLoggedIn()): ?>
    <div class="actions">
        <a href="commentaire.php" class="btn btn-primary">Ajouter un commentaire</a>
    </div>
<?php else: ?>
    <div class="alert alert-info">
        <a href="connexion.php">Connectez-vous</a> pour pouvoir ajouter un commentaire.
    </div>
<?php endif; ?>

<div class="commentaires-list">
    <?php if (empty($data['commentaires'])): ?>
        <div class="no-comments">
            <p>Aucun commentaire pour le moment. Soyez le premier à laisser votre avis !</p>
        </div>
    <?php else: ?>
        <?php foreach ($data['commentaires'] as $commentaire): ?>
            <div class="commentaire">
                <div class="commentaire-header">
                    <span class="commentaire-info">
                        Posté le <?php echo date('d/m/Y', strtotime($commentaire['date'])); ?> 
                        par <strong><?php echo escape($commentaire['login']); ?></strong>
                    </span>
                </div>
                <div class="commentaire-content">
                    <?php echo nl2br(escape($commentaire['commentaire'])); ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>