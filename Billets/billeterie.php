<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billeterie</title>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="billeterie.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Billetterie du Zoo de la Barben</h1>
        <p>Réservez vos billets en ligne et recevez-les immédiatement !</p>
    </header>
 
    <section class="reservation-section">
        <h2>Réserver vos billets</h2>
        <form id="reservation-form" name="reservation-form" method="POST" target="_blank" action="billeterie_genere.php">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['email']) : ''; ?>" readonly>
 
            <label for="ticket-type">Type de billet</label>
            <select id="ticket-type" name="ticketType" required>
                <option value="adulte">Adulte - 20 €</option>
                <option value="enfant">Enfant - 12 €</option>
                <option value="bebe">Bébé - Gratuit</option>
                <option value="famille">Famille - 60 €</option>
            </select>
 
            <label for="quantity">Quantité</label>
            <input type="number" id="quantity" name="quantity" min="1" max="10" required>
			<br/>
            <label for="visit-date">Date de visite</label>
            <input type="date" id="visit-date" name="visitDate" required>
 
            <button type="submit" class="cta-button">Réserver</button>
        </form>
    </section>
</body>
</html>