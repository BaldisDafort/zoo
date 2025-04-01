<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nausicaa</title>
	<link href="./mes_styles.css" rel="stylesheet" type="text/css">

</head>
<x>    
	<?php
	include("./nav.html");
    if (isset($_GET["p"])) {
        if ($_GET["p"] == "avis") {
            include("./Avis/avis.php");
        } elseif ($_GET["p"] == "contact") {
            include("./Contact/contact.php");
        } elseif ($_GET["p"] == "nosanimaux") {
            include("./Animaux/nosanimaux.php");
        } elseif ($_GET["p"] == "enclos") {
            include("./Enclos/enclos.php");
        } elseif ($_GET["p"] == "connexion") {
            include("./Back_Office/auth.php");
        } elseif ($_GET["p"] == "reserver") {
            include("./Billets/billeterie.php");
        } elseif ($_GET["p"] == "boutique") {
            include("./Liens/boutique.php");
        } elseif ($_GET["p"] == "restauration") {
            include("./Liens/restauration.php");
        } elseif ($_GET["p"] == "faq") {
            include("./Liens/faq.php");
        }
    } else include("./accueil.html");
	?>

    <div class="map-container">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2521.031165226153!2d1.591928315730758!3d50.73048732782267!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47dc2c135521ce51%3A0xd6e845d18f81937f!2sNausicaa%20Centre%20National%20De%20La%20Mer!5e0!3m2!1sfr!2sfr!4v1706800000000!5m2!1sfr!2sfr" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
    </div>

</body>
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
            <div class="footer-section">
                <h4>Liens utiles</h4>
                <ul class="footer-links">
                    <li><a href="./images/plan.jpg">Plan du zoo</a></li>
                    <li><a href="./index.php?p=restauration">Restauration</a></li>
                    <li><a href="./index.php?p=boutique">Boutique</a></li>
                    <li><a href="./index.php?p=faq">FAQ</a></li>
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
</html>