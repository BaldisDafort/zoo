<?php
// Vérifier si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

// Traitement du changement de rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['new_role'])) {
    try {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$_POST['new_role'], $_POST['user_id']]);
        $success = "Rôle mis à jour avec succès";
    } catch (PDOException $e) {
        $error = "Erreur lors de la mise à jour du rôle : " . $e->getMessage();
    }
}

// Récupération de la liste des utilisateurs
try {
    $stmt = $pdo->query("SELECT id, nickname, email, role FROM users ORDER BY role DESC, id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Filtrer les administrateurs
    $admins = array_filter($users, function($user) {
        return $user['role'] === 'admin';
    });
} catch (PDOException $e) {
    $error = "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}
?>

<div class="admin-page">
    <div class="admin-container">
        <h1>Gestion des utilisateurs</h1>
        
        <?php if (isset($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="admin-section">
            <h2>Administrateurs actuels</h2>
            <div class="admin-list">
                <?php if (empty($admins)): ?>
                    <p>Aucun administrateur trouvé.</p>
                <?php else: ?>
                    <ul>
                        <?php foreach ($admins as $admin): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($admin['nickname']); ?></strong>
                                (<?php echo htmlspecialchars($admin['email']); ?>)
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <h2>Liste complète des utilisateurs</h2>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pseudonyme</th>
                    <th>Email</th>
                    <th>Rôle actuel</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['nickname']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['role']; ?></td>
                    <td>
                        <form method="POST" class="role-form">
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                            <select name="new_role" onchange="this.form.submit()">
                                <option value="client" <?php echo $user['role'] === 'client' ? 'selected' : ''; ?>>Client</option>
                                <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="admin-actions">
            <a href="../index.php?p=admin" class="admin-button">Retour au panneau d'administration</a>
        </div>
    </div>
</div> 