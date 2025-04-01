<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Zoo de la Barben</title>
	<LINK href="../mes_styles.css" rel="stylesheet" type="text/css">
	<LINK href="./Contact/contact.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="contact-container">
    <h1>Contactez-nous</h1>

    <div class="contact-info">
        <p><strong>Adresse :</strong> Zoo de la Barben, 13330 La Barben, France</p>
        <p><strong>Téléphone :</strong> +33 4 90 55 19 12</p>
        <p><strong>Email :</strong> contact@zoodelabarben.com</p>
        <p><strong>Horaires d'ouverture :</strong> Tous les jours de 10h à 18h</p>
    </div>

    <div class="contact-form">
        <h2>Envoyez-nous un message</h2>
        <form action="submit_form.php" method="post">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit" class="submit-button">Envoyer</button>
        </form>
    </div>
</body>

</html>
