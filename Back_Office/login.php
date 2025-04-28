<?php
ob_start(); // Démarre le buffer de sortie
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/notifications.php';

// Récupérer la page d'origine
$redirect_page = $_GET['redirect'] ?? '';

// Si l'utilisateur est déjà connecté, rediriger vers la page demandée ou l'accueil
if (isset($_SESSION['user'])) {
    if ($redirect_page) {
        header('Location: ../index.php?p=' . $redirect_page);
    } else {
        header('Location: ../index.php?p=profil');
    }
    exit();
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            $_SESSION['success_message'] = 'Connexion réussie !';
            
            // Stocker la page de redirection dans la session
            if ($redirect_page) {
                $_SESSION['redirect_after_login'] = $redirect_page;
            }
            
            // Rediriger vers index.php qui gérera la redirection finale
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    } catch (PDOException $e) {
        $error = "Erreur de connexion : " . $e->getMessage();
    }
}
?>

<div class="login-page">
    <div class="login-container">
        <h1>Connexion</h1>
        <?php if (isset($error)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($redirect_page); ?>">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="cta-button">Se connecter</button>
        </form>
        
        <p class="register-link">Pas encore de compte ? <a href="../index.php?p=register">S'inscrire</a></p>
    </div>
</div>

<?php if (isset($error)): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toastify({
            text: "<?php echo addslashes($error); ?>",
            duration: 3000,
            gravity: "top",
            position: "right",
            className: "toastify-error",
            stopOnFocus: true
        }).showToast();
    });
</script>
<?php endif; ?>
