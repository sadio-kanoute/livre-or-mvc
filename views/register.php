<h2>Inscription</h2>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-error"><?php echo escape($data['error']); ?></div>
<?php endif; ?>

<?php if (!empty($data['success'])): ?>
    <div class="alert alert-success"><?php echo escape($data['success']); ?></div>
<?php endif; ?>

<form method="POST" class="form-auth">
    <div class="form-group">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" value="<?php echo escape($data['formData']['login'] ?? ''); ?>" required>
    </div>
    
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div class="form-group">
        <label for="confirm_password">Confirmer le mot de passe :</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<p class="text-center">
    <a href="connexion.php">Déjà inscrit ? Se connecter</a>
</p>