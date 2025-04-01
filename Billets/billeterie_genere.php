<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billetterie - Zoo de la Barben</title>
    <link rel="stylesheet" href="style.css">
	<LINK href="../mes_styles.css" rel="stylesheet" type="text/css">
</head>
<style>
/* Styles généraux */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f3f4f6;
    color: #333;
}
 
header {
    text-align: center;
    padding: 40px 20px;
    background-color: #4CAF50;
    color: white;
}
 
h1, h2 {
    margin: 0 0 10px;
    font-weight: 600;
}
 
p {
    margin: 0 0 20px;
}
 
.ticket-section, .reservation-section {
    margin: 40px auto;
    padding: 20px;
    max-width: 700px;
    text-align: center;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
 
/* Bouton principal */
.cta-button {
    display: inline-block;
    background-color: #4CAF50;
    color: white;
    padding: 12px 25px;
    font-size: 1.1em;
    font-weight: bold;
    border-radius: 8px;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: background-color 0.3s;
}
 
.cta-button:hover {
    background-color: #45a049;
}
 
/* Lien de téléchargement */
.download-link {
    display: none;
    margin-top: 20px;
    font-size: 1em;
    color: #4CAF50;
    text-decoration: none;
    font-weight: bold;
}
 
.download-link:hover {
    text-decoration: underline;
}
</style>
<body>
    <header>
		<table align="center" width="100%">
			<tr>
				<td width="25%"><img src="../images/logo.png"/></td>
				<td width="50%"><h1>Billetterie du Zoo de la Barben</h1></td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</header>
 
    <section class="reservation-section">
		<table align="center">
			<th>
				<td colspan="2"><h2>Votre billet numérique</h2></td>
			</th>
			 
			<tr>
				<td><img src="../images/qr_code.png"/></td>
				<td>
					<label for="email"><b>Adresse e-mail : </b></label>
					<?php echo $_POST["email"];?> 
					<br/>
					<label for="ticket-type"><b>Type de billet : </b></label>
					<?php 
					if ($_POST["ticketType"]=="adulte") {
						echo "Adulte - 20 €";
					} elseif ($_POST["ticketType"]=="enfant") {
						echo "Enfant - 12 €";
					} elseif ($_POST["ticketType"]=="bebe") {
						echo "Bébé - Gratuit";
					} else {
						echo "Famille - 60 €";
					}
					?>
					<br/>
					<label for="quantity"><b>Quantité : </b></label>
					<?php echo $_POST["quantity"];?>
					<br/>
					<label for="visit-date"><b>Date de visite : </b></label>
					<?php echo date('d/m/Y',strtotime($_POST["visitDate"]));?></td>
			</tr>            
		</table>
    </section>
</body>
</html>