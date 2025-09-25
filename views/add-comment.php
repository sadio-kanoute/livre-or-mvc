<h2>Ajouter un commentaire</h2>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-error"><?php echo escape($data['error']); ?></div>
<?php endif; ?>

<?php if (!empty($data['success'])): ?>
    <div class="alert alert-success"><?php echo escape($data['success']); ?></div>
<?php endif; ?>

<form method="POST" class="form-comment">
    <div class="form-group">
        <label for="commentaire">Votre commentaire :</label>
        <textarea id="commentaire" name="commentaire" rows="6" placeholder="Partagez votre expérience..." required><?php echo escape($data['formData']['commentaire'] ?? ''); ?></textarea>
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Publier le commentaire</button>
        <a href="livre-or.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<div class="user-info">
    <p>Connecté en tant que : <strong><?php echo escape($_SESSION['login']); ?></strong></p>
</div>