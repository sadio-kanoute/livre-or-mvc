<h2>Modifier mon profil</h2>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-error"><?php echo escape($data['error']); ?></div>
<?php endif; ?>

<?php if (!empty($data['success'])): ?>
    <div class="alert alert-success"><?php echo escape($data['success']); ?></div>
<?php endif; ?>

<form method="POST" class="form-auth">
    <div class="form-group">
        <label for="login">Nouveau login :</label>
        <input type="text" id="login" name="login" value="<?php echo escape($data['userData']['login'] ?? ''); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="password">Nouveau mot de passe (optionnel) :</label>
        <input type="password" id="password" name="password" placeholder="Laissez vide pour conserver l'ancien">
    </div>
    
    <div class="form-group">
        <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Seulement si vous changez le mot de passe">
    </div>
    
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="livre-or.php" class="btn btn-secondary">Annuler</a>
    </div>
</form>

<div class="profile-info">
    <h3>Informations actuelles</h3>
    <p><strong>Login actuel :</strong> <?php echo escape($_SESSION['login']); ?></p>
    <p><strong>ID utilisateur :</strong> <?php echo $_SESSION['user_id']; ?></p>
</div>