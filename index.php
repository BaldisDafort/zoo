<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config.php';

// Gérer les redirections avant tout contenu
if (isset($_GET['p'])) {
    $page = $_GET['p'];
    
    // Gestion de la déconnexion
    if ($page === 'logout') {
        session_destroy();
        header('Location: index.php');
        exit();
    }
    
    // Vérification des pages protégées
    $protected_pages = ['avis', 'reserver'];
    if (in_array($page, $protected_pages) && !isset($_SESSION['user'])) {
        $_SESSION['redirect_after_login'] = $page;
        header('Location: index.php?p=connexion');
        exit();
    }
    
    // Redirection si déjà connecté et essaye d'accéder à la page de connexion
    if ($page === 'connexion' && isset($_SESSION['user'])) {
        if (isset($_SESSION['redirect_after_login'])) {
            $redirect = $_SESSION['redirect_after_login'];
            unset($_SESSION['redirect_after_login']);
            header('Location: index.php?p=' . $redirect);
            exit();
        } else {
            header('Location: index.php?p=profil');
            exit();
        }
    }
} else {
    $page = '';
}

// Redirection après connexion réussie
if (isset($_SESSION['redirect_after_login']) && isset($_SESSION['user'])) {
    $redirect = $_SESSION['redirect_after_login'];
    unset($_SESSION['redirect_after_login']);
    header('Location: index.php?p=' . $redirect);
    exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
        <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-K6FCSHGKS0"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-K6FCSHGKS0');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nausicaa</title>
    <!-- CSS principal -->
    <link href="style.css" rel="stylesheet" type="text/css">
    <!-- CSS des modules -->
    <link href="Back_Office/login.css" rel="stylesheet" type="text/css">
    <link href="Back_Office/profile.css" rel="stylesheet" type="text/css">
    <link href="Back_Office/admin.css" rel="stylesheet" type="text/css">
    <link href="Avis/avis.css" rel="stylesheet" type="text/css">
    <link href="Enclos/enclos.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Scripts -->
    <script src="Enclos/enclos.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        window.onload = function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.nav-links');
            
            if (!menuToggle || !navLinks) {
                return;
            }

            function checkNavMode() {
                return window.innerWidth <= 768;
            }

            checkNavMode();

            window.addEventListener('resize', checkNavMode);

            menuToggle.addEventListener('click', function() {
                navLinks.classList.toggle('active');
            });

            const navLinksItems = document.querySelectorAll('.nav-links a');
            navLinksItems.forEach(link => {
                link.addEventListener('click', () => {
                    navLinks.classList.remove('active');
                });
            });
        };
    </script>
</head>
<body>
    <?php include("./nav.html"); ?>
    <?php
    if (!empty($page)) {
        switch($page) {
            case "avis":
                include("./Avis/avis.php");
                break;
            case "avis_save":
                include("./Avis/avis_save.php");
                break;
            case "enclos":
                include("./Enclos/enclos.php");
                break;
            case "register":
                include("./Back_Office/register.php");
                break;
            case "reserver":
                include("./Billets/billeterie.php");
                break;
            case "profil":
                include("./Back_Office/profile.php");
                break;
            case "edit_profile":
                include("./Back_Office/edit_profile.php");
                break;
            case "connexion":
                include("./Back_Office/login.php");
                break;
            case "admin":
                include("./Back_Office/admin.php");
                break;
            case "liste_users":
                include("./Back_Office/liste_users.php");
                break;
            case "logout":
                session_destroy();
                header('Location: index.php');
                exit();
                break;
            default:
                include("./accueil.html");
        }
    } else {
        include("./accueil.html");
    }
    ?>

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

    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2521.031165226153!2d1.591928315730758!3d50.73048732782267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47dc2c135521ce51%3A0xd6e845d18f81937f!2sNausicaa%20Centre%20National%20De%20La%20Mer!5e0!3m2!1sfr!2sfr!4v1706800000000!5m2!1sfr!2sfr" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h4>Contact</h4>
                <ul class="footer-links">
                    <li>Boulevard Sainte-Beuve</li>
                    <li>62 200 Boulogne-sur-mer</li>
                    <li>Tél : +33 03 21 30 99 99</li>
                    <li>Email : contact@zoonausicaa.com</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Horaires</h4>
                <ul class="footer-links">
                    <li>Ouvert tous les jours</li>
                    <li>9h30 - 17h00</li>
                </ul>
            </div>
            <div>
                <h4>Suivez-nous</h4>
                <ul class="footer-links">
                    <li><a href="https://www.facebook.com/zoodelabarben" target="_blank">Facebook</a></li>
                    <li><a href="https://www.instagram.com/zoodelabarben" target="_blank">Instagram</a></li>
                    <li><a href="https://twitter.com/zoodelabarben" target="_blank">Twitter</a></li>
                    <li><a href="https://www.youtube.com/@zoolabarben" target="_blank">YouTube</a></li>
                </ul>
            </div>
        </div>
    </footer>
</body>
</html>