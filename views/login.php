<h2>Connexion</h2>

<?php if (!empty($data['error'])): ?>
    <div class="alert alert-error"><?php echo escape($data['error']); ?></div>
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
    
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<p class="text-center">
    <a href="inscription.php">Pas encore inscrit ? S'inscrire</a>
</p>