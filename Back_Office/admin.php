<?php
// Ne pas démarrer la session ici car elle est déjà démarrée dans index.php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/functions.php';

// Configuration du logging
$log_file = __DIR__ . '/../logs/debug.log';
if (!file_exists(dirname($log_file))) {
    mkdir(dirname($log_file), 0777, true);
}

function write_log($message) {
    global $log_file;
    $date = date('Y-m-d H:i:s');
    file_put_contents($log_file, "[$date] $message\n", FILE_APPEND);
}

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

write_log("Début du chargement de admin.php");

// Test simple pour vérifier si le fichier est chargé
echo "<!-- Test de chargement de admin.php -->";

// Vérifier si l'utilisateur est connecté et est admin
if (!isset($_SESSION['user'])) {
    write_log("Utilisateur non connecté");
    header('Location: ../index.php?p=connexion');
    exit();
}

write_log("Utilisateur connecté : " . $_SESSION['user']['email']);

if ($_SESSION['user']['role'] !== 'admin') {
    write_log("Utilisateur non admin : " . $_SESSION['user']['role']);
    header('Location: ../index.php?p=profil');
    exit();
}

write_log("Utilisateur est admin");

// Traitement des modifications
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    write_log("Traitement d'une requête POST");
    if (isset($_POST['action'])) {
        write_log("Action : " . $_POST['action']);
        switch ($_POST['action']) {
            case 'update_user':
                try {
                    $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
                    $stmt->execute([$_POST['role'], $_POST['user_id']]);
                    $_SESSION['success_message'] = "Utilisateur mis à jour avec succès";
                    write_log("Utilisateur mis à jour avec succès");
                } catch (PDOException $e) {
                    write_log("Erreur mise à jour utilisateur: " . $e->getMessage());
                    $_SESSION['error_message'] = "Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage();
                }
                break;

            case 'delete_user':
                try {
                    // Ne pas permettre la suppression de son propre compte
                    if ($_POST['user_id'] == $_SESSION['user']['id']) {
                        throw new Exception("Vous ne pouvez pas supprimer votre propre compte");
                    }
                    
                    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
                    $stmt->execute([$_POST['user_id']]);
                    $_SESSION['success_message'] = "Utilisateur supprimé avec succès";
                    write_log("Utilisateur supprimé avec succès");
                } catch (Exception $e) {
                    write_log("Erreur suppression utilisateur: " . $e->getMessage());
                    $_SESSION['error_message'] = "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
                }
                break;

            case 'update_enclos':
                try {
                    $stmt = $pdo->prepare("UPDATE enclos SET h_deb_repas = ?, h_fin_repas = ?, Statut = ? WHERE id = ?");
                    $stmt->execute([$_POST['h_deb_repas'], $_POST['h_fin_repas'], $_POST['Statut'], $_POST['enclos_id']]);
                    $_SESSION['success_message'] = "Enclos mis à jour avec succès";
                    write_log("Enclos mis à jour avec succès");
                } catch (PDOException $e) {
                    write_log("Erreur mise à jour enclos: " . $e->getMessage());
                    $_SESSION['error_message'] = "Erreur lors de la mise à jour de l'enclos : " . $e->getMessage();
                }
                break;

            case 'update_animal':
                try {
                    $stmt = $pdo->prepare("UPDATE animal SET nom = ?, origine = ?, sexe = ?, naissance = ? WHERE id = ?");
                    $stmt->execute([$_POST['nom'], $_POST['origine'], $_POST['sexe'], $_POST['naissance'], $_POST['animal_id']]);
                    $_SESSION['success_message'] = "Animal mis à jour avec succès";
                    write_log("Animal mis à jour avec succès");
                } catch (PDOException $e) {
                    write_log("Erreur mise à jour animal: " . $e->getMessage());
                    $_SESSION['error_message'] = "Erreur lors de la mise à jour de l'animal : " . $e->getMessage();
                }
                break;

            case 'delete_animal':
                try {
                    $stmt = $pdo->prepare("DELETE FROM animal WHERE id = ?");
                    $stmt->execute([$_POST['animal_id']]);
                    $_SESSION['success_message'] = "Animal supprimé avec succès";
                    write_log("Animal supprimé avec succès");
                } catch (Exception $e) {
                    write_log("Erreur suppression animal: " . $e->getMessage());
                    $_SESSION['error_message'] = "Erreur lors de la suppression de l'animal : " . $e->getMessage();
                }
                break;

            case 'add_animal':
                try {
                    $stmt = $pdo->prepare("INSERT INTO animal (nom, origine, sexe, naissance) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$_POST['nom'], $_POST['origine'], $_POST['sexe'], $_POST['naissance']]);
                    $_SESSION['success_message'] = "Animal ajouté avec succès";
                    write_log("Animal ajouté avec succès");
                } catch (PDOException $e) {
                    write_log("Erreur ajout animal: " . $e->getMessage());
                    $_SESSION['error_message'] = "Erreur lors de l'ajout de l'animal : " . $e->getMessage();
                }
                break;
        }
    }
}

// Récupération des données
try {
    write_log("Tentative de récupération des utilisateurs");
    $stmt = $pdo->query("SELECT * FROM users ORDER BY id");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    write_log("Nombre d'utilisateurs récupérés : " . count($users));
} catch (PDOException $e) {
    write_log("Erreur récupération utilisateurs: " . $e->getMessage());
    $_SESSION['error_message'] = "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}

try {
    write_log("Tentative de récupération des enclos");
    $stmt = $pdo->query("SELECT * FROM enclos ORDER BY id");
    $enclos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    write_log("Nombre d'enclos récupérés : " . count($enclos));
} catch (PDOException $e) {
    write_log("Erreur récupération enclos: " . $e->getMessage());
    $_SESSION['error_message'] = "Erreur lors de la récupération des enclos : " . $e->getMessage();
}

try {
    write_log("Tentative de récupération des animaux");
    $stmt = $pdo->query("SELECT * FROM animal ORDER BY id");
    $animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
    write_log("Nombre d'animaux récupérés : " . count($animaux));
} catch (PDOException $e) {
    write_log("Erreur récupération animaux: " . $e->getMessage());
    $_SESSION['error_message'] = "Erreur lors de la récupération des animaux : " . $e->getMessage();
}

write_log("Fin du chargement de admin.php");
?>

<div class="admin-page">
    <div class="admin-container">
        <h1>Panneau d'administration</h1>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>

        <section class="admin-section">
            <h2>Gestion des utilisateurs</h2>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pseudo</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($users) && !empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td class="readonly-cell"><?php echo htmlspecialchars($user['nickname']); ?></td>
                                <td class="readonly-cell"><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <select name="role" class="admin-form-select" form="update-form-<?php echo $user['id']; ?>">
                                        <option value="client" <?php echo $user['role'] === 'client' ? 'selected' : ''; ?>>Client</option>
                                        <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    </select>
                                </td>
                                <td>
                                    <form id="update-form-<?php echo $user['id']; ?>" method="POST" class="admin-inline-form">
                                        <input type="hidden" name="action" value="update_user">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="admin-btn-save">Enregistrer</button>
                                        <?php if ($user['id'] != $_SESSION['user']['id']): ?>
                                        <button type="button" class="admin-btn-delete" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) { document.getElementById('delete-form-<?php echo $user['id']; ?>').submit(); }">Supprimer</button>
                                        <?php endif; ?>
                                    </form>
                                    <?php if ($user['id'] != $_SESSION['user']['id']): ?>
                                    <form id="delete-form-<?php echo $user['id']; ?>" method="POST" style="display: none;">
                                        <input type="hidden" name="action" value="delete_user">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Aucun utilisateur trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-section">
            <h2>Gestion des enclos</h2>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Animal</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            // Récupération des enclos avec leurs animaux
                            $stmt = $pdo->query("SELECT e.*, a.name as animal_name 
                                               FROM enclos e 
                                               LEFT JOIN animaux a ON e.id = a.id 
                                               ORDER BY e.id");
                            $enclos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if (!empty($enclos)) {
                                foreach ($enclos as $enclos_item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $enclos_item['id']; ?></td>
                                        <td><?php echo htmlspecialchars($enclos_item['animal_name']); ?></td>
                                        <td>
                                            <form method="POST" class="inline-form">
                                                <input type="hidden" name="action" value="update_enclos">
                                                <input type="hidden" name="enclos_id" value="<?php echo $enclos_item['id']; ?>">
                                                <select name="Statut" class="form-select">
                                                    <option value="1" <?php echo ($enclos_item['Statut'] == 1) ? 'selected' : ''; ?>>Ouvert</option>
                                                    <option value="0" <?php echo ($enclos_item['Statut'] == 0) ? 'selected' : ''; ?>>Fermé</option>
                                                </select>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn-save">Enregistrer</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='4'>Aucun enclos trouvé</td></tr>";
                            }
                        } catch (PDOException $e) {
                            write_log("Erreur récupération enclos: " . $e->getMessage());
                            echo "<tr><td colspan='4'>Erreur lors de la récupération des enclos</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-section">
            <h2>Gestion des animaux</h2>
            
            <!-- Formulaire d'ajout d'animal -->
            <div class="add-form-container">
                <h3>Ajouter un nouvel animal</h3>
                <form method="POST" class="admin-add-form">
                    <input type="hidden" name="action" value="add_animal">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="new_nom">Nom :</label>
                            <input type="text" id="new_nom" name="nom" required class="admin-form-input">
                        </div>
                        <div class="form-group">
                            <label for="new_origine">Origine :</label>
                            <input type="text" id="new_origine" name="origine" required class="admin-form-input">
                        </div>
                        <div class="form-group">
                            <label for="new_sexe">Sexe :</label>
                            <select id="new_sexe" name="sexe" required class="admin-form-select">
                                <option value="">Sélectionner</option>
                                <option value="H">Mâle</option>
                                <option value="F">Femelle</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="new_naissance">Date de naissance :</label>
                            <input type="date" id="new_naissance" name="naissance" required class="admin-form-input">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="admin-btn-add">Ajouter l'animal</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Origine</th>
                            <th>Sexe</th>
                            <th>Date de naissance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($animaux) && !empty($animaux)): ?>
                            <?php foreach ($animaux as $animal): ?>
                            <tr>
                                <td><?php echo $animal['id']; ?></td>
                                <td>
                                    <input type="text" name="nom" value="<?php echo htmlspecialchars($animal['nom']); ?>" class="admin-form-input" form="update-animal-form-<?php echo $animal['id']; ?>">
                                </td>
                                <td>
                                    <input type="text" name="origine" value="<?php echo htmlspecialchars($animal['origine']); ?>" class="admin-form-input" form="update-animal-form-<?php echo $animal['id']; ?>">
                                </td>
                                <td>
                                    <select name="sexe" class="admin-form-select" form="update-animal-form-<?php echo $animal['id']; ?>">
                                        <option value="H" <?php echo $animal['sexe'] === 'H' ? 'selected' : ''; ?>>Mâle</option>
                                        <option value="F" <?php echo $animal['sexe'] === 'F' ? 'selected' : ''; ?>>Femelle</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="date" name="naissance" value="<?php echo $animal['naissance']; ?>" class="admin-form-input" form="update-animal-form-<?php echo $animal['id']; ?>">
                                </td>
                                <td>
                                    <form id="update-animal-form-<?php echo $animal['id']; ?>" method="POST" class="admin-inline-form">
                                        <input type="hidden" name="action" value="update_animal">
                                        <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                                        <button type="submit" class="admin-btn-save">Enregistrer</button>
                                        <button type="button" class="admin-btn-delete" onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cet animal ?')) { document.getElementById('delete-animal-form-<?php echo $animal['id']; ?>').submit(); }">Supprimer</button>
                                    </form>
                                    <form id="delete-animal-form-<?php echo $animal['id']; ?>" method="POST" style="display: none;">
                                        <input type="hidden" name="action" value="delete_animal">
                                        <input type="hidden" name="animal_id" value="<?php echo $animal['id']; ?>">
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">Aucun animal trouvé</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<?php
// Traitement des modifications
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_enclos') {
    try {
        // Log des données reçues
        write_log("Données reçues pour mise à jour : " . print_r($_POST, true));
        
        // Vérifier que le statut est bien reçu
        $statut = isset($_POST['Statut']) ? (int)$_POST['Statut'] : 0;
        write_log("Valeur du statut : " . $statut);
        
        $stmt = $pdo->prepare("UPDATE enclos SET h_deb_repas = ?, h_fin_repas = ?, Statut = ? WHERE id = ?");
        $result = $stmt->execute([
            $_POST['h_deb_repas'],
            $_POST['h_fin_repas'],
            $statut,
            $_POST['enclos_id']
        ]);
        
        // Vérifier si la mise à jour a réussi
        if ($result) {
            write_log("Mise à jour réussie pour l'enclos " . $_POST['enclos_id']);
            $_SESSION['success_message'] = "Enclos mis à jour avec succès";
        } else {
            write_log("Échec de la mise à jour pour l'enclos " . $_POST['enclos_id']);
            $_SESSION['error_message'] = "Erreur lors de la mise à jour de l'enclos";
        }
        
        // Redirection vers la page admin
        header('Location: ../index.php?p=admin');
        exit();
    } catch (PDOException $e) {
        write_log("Erreur mise à jour enclos: " . $e->getMessage());
        $_SESSION['error_message'] = "Erreur lors de la mise à jour de l'enclos : " . $e->getMessage();
    }
}
?>
