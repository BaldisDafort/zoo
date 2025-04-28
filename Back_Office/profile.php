<?php
// Ne pas démarrer la session ici car elle est déjà démarrée dans index.php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/functions.php';

// Vérifier si l'utilisateur est connecté
requireRole('client');

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
            <?php if ($user['role'] === 'admin'): ?>
            <div class="info-group">
                <label>Type de compte :</label>
                <p>Administrateur</p>
            </div>
            <?php endif; ?>
            <div class="profile-actions">
                <a href="../index.php?p=edit_profile" class="cta-button">Modifier mon profil</a>
                <?php if ($user['role'] === 'admin'): ?>
                <a href="../index.php?p=admin" class="cta-button">Panneau d'administration</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['success_message'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toastify({
            text: "<?php echo addslashes($_SESSION['success_message']); ?>",
            duration: 3000,
            gravity: "top",
            position: "right",
            className: "toastify-success",
            stopOnFocus: true
        }).showToast();
    });
</script>
<?php 
// Supprimer le message après l'avoir affiché
unset($_SESSION['success_message']);
endif; 
?>
