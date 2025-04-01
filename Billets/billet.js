const express = require('express');
const nodemailer = require('nodemailer');
const PDFDocument = require('pdfkit');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');
 
const app = express();
const ticketsDir = path.join(__dirname, 'tickets');
 
// Créer un dossier pour les billets s'il n'existe pas
if (!fs.existsSync(ticketsDir)) {
    fs.mkdirSync(ticketsDir);
}
 
app.use(bodyParser.json());
 
// Configuration de Nodemailer
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: 'votre-email@gmail.com',
        pass: 'votre-mot-de-passe',
    },
});
 
// Endpoint pour traiter la réservation
app.post('/reserve', (req, res) => {
    const { email, ticketType, quantity, visitDate } = req.body;
 
    // Vérification des données reçues
    if (!email || !ticketType || !quantity || !visitDate) {
        return res.status(400).json({ error: 'Données invalides' });
    }
 
    // Générer un billet PDF
    const fileName = `ticket_${Date.now()}.pdf`;
    const filePath = path.join(ticketsDir, fileName);
 
    const doc = new PDFDocument();
    doc.pipe(fs.createWriteStream(filePath));
    doc.fontSize(18).text('Billet - Zoo de la Barben', { align: 'center' });
    doc.moveDown();
    doc.fontSize(14).text(`Type de billet : ${ticketType}`);
    doc.text(`Quantité : ${quantity}`);
    doc.text(`Date de visite : ${visitDate}`);
    doc.end();
 
    // Envoyer un e-mail avec le billet
    transporter.sendMail({
        from: 'votre-email@gmail.com',
        to: email,
        subject: 'Votre Billet - Zoo de la Barben',
        text: 'Merci pour votre réservation. Veuillez trouver votre billet en pièce jointe.',
        attachments: [{ filename: fileName, path: filePath }],
    }, (err) => {
        if (err) {
            console.error('Erreur envoi e-mail : ', err);
        }
    });
 
    // Répondre avec un lien de téléchargement
    res.json({ downloadUrl: `/tickets/${fileName}` });
});
 
// Servir les billets statiquement
app.use('/tickets', express.static(ticketsDir));
 
// Démarrer le serveur
app.listen(3000, () => console.log('Serveur en écoute sur le port 3000'));