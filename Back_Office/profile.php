<?php
// Ne pas démarrer la session ici car elle est déjà démarrée dans index.php
require_once __DIR__ . '/../config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php?p=connexion');
    exit();
}

// Récupérer les informations de l'utilisateur
$user = $_SESSION['user'];
?>

<div class="profile-page">
    <div class="profile-container">
        <h1>Mon Profil</h1>
        <div class="profile-info">
            <div class="info-group">
                <label>Pseudo :</label>
                <p><?php echo htmlspecialchars($user['nickname']); ?></p>
            </div>
            <div class="info-group">
                <label>Email :</label>
                <p><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <div class="info-group">
                <label>Type de compte :</label>
                <p><?php echo $user['fk_id_profil'] == 1 ? 'Administrateur' : 'Utilisateur'; ?></p>
            </div>
            <div class="profile-actions">
                <a href="../index.php?p=edit_profile" class="cta-button">Modifier mon profil</a>
            </div>
        </div>
    </div>
</div>
