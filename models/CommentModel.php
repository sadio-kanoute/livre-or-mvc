<?php
/**
 * MODEL - Commentaire
 * Fonctions pour gérer les commentaires
 */

// Récupérer tous les commentaires avec infos utilisateurs
function getAllComments() {
    $pdo = getConnection();
    $stmt = $pdo->prepare("
        SELECT c.id, c.commentaire, c.date, u.login 
        FROM commentaires c 
        JOIN utilisateurs u ON c.id_utilisateur = u.id 
        ORDER BY c.date DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll();
}

// Ajouter un nouveau commentaire
function addComment($userId, $commentaire) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES (?, ?, NOW())");
    return $stmt->execute([$commentaire, $userId]);
}

// Récupérer les commentaires d'un utilisateur
function getCommentsByUser($userId) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("
        SELECT c.id, c.commentaire, c.date 
        FROM commentaires c 
        WHERE c.id_utilisateur = ? 
        ORDER BY c.date DESC
    ");
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

// Supprimer un commentaire (optionnel)
function deleteComment($commentId, $userId) {
    $pdo = getConnection();
    $stmt = $pdo->prepare("DELETE FROM commentaires WHERE id = ? AND id_utilisateur = ?");
    return $stmt->execute([$commentId, $userId]);
}
?>