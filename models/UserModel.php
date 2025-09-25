<?php
/**
 * MODEL - Utilisateur
 * Fonctions pour gérer les utilisateurs
 */

// Créer un nouvel utilisateur
function createUser($login, $password) {
    $pdo = getConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, password) VALUES (?, ?)");
    return $stmt->execute([$login, $hashedPassword]);
}

// Vérifier si un login existe déjà
function loginExists($login, $excludeUserId = null) {
    $pdo = getConnection();
    
    if ($excludeUserId) {
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = ? AND id != ?");
        $stmt->execute([$login, $excludeUserId]);
    } else {
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE login = ?");
        $stmt->execute([$login]);
    }
    
    return $stmt->rowCount() > 0;
}

// Authentifier un utilisateur
function authenticateUser($login, $password) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT id, login, password FROM utilisateurs WHERE login = ?");
    $stmt->execute([$login]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    
    return false;
}

// Récupérer les données d'un utilisateur
function getUserById($userId) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("SELECT id, login FROM utilisateurs WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

// Mettre à jour le profil utilisateur
function updateUser($userId, $newLogin, $newPassword = null) {
    $pdo = getConnection();
    
    if ($newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET login = ?, password = ? WHERE id = ?");
        return $stmt->execute([$newLogin, $hashedPassword, $userId]);
    } else {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        return $stmt->execute([$newLogin, $userId]);
    }
}
?>