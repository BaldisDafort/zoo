<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Zoo de la Barben</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" rel="stylesheet">
    <LINK href="../mes_styles.css" rel="stylesheet" type="text/css">
    <LINK href="./Liens/faq.css" rel="stylesheet" type="text/css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const questions = document.querySelectorAll(".question");
            questions.forEach(question => {
                question.addEventListener("click", function() {
                    const answer = this.nextElementSibling;
                    answer.style.display = answer.style.display === "block" ? "none" : "block";
                });
            });
        });
    </script>
</head>
<body>

<div class="faq-container">
    <h1>FAQ - Zoo de la Barben</h1>

    <div class="faq-item">
        <div class="question">Quels sont les horaires d'ouverture du zoo ?</div>
        <div class="answer">Le Zoo de la Barben est ouvert tous les jours de 10h à 18h. Les horaires peuvent varier en fonction des saisons, donc consultez notre site avant votre visite.</div>
    </div>

    <div class="faq-item">
        <div class="question">Est-il possible d'acheter des billets en ligne ?</div>
        <div class="answer">Oui, vous pouvez acheter vos billets en ligne sur notre page billetterie. Cela vous permet d'éviter les files d'attente à l'entrée.</div>
    </div>

    <div class="faq-item">
        <div class="question">Quels types d'animaux peut-on voir au zoo ?</div>
        <div class="answer">Le zoo abrite plus de 700 animaux, y compris des lions, des girafes, des rhinocéros, des oiseaux exotiques, et bien plus encore.</div>
    </div>

    <div class="faq-item">
        <div class="question">Le zoo propose-t-il des visites guidées ?</div>
        <div class="answer">Oui, nous proposons des visites guidées pour les groupes et les écoles. Veuillez nous contacter pour plus d'informations et pour réserver.</div>
    </div>

    <div class="faq-item">
        <div class="question">Y a-t-il des zones de restauration dans le zoo ?</div>
        <div class="answer">Oui, nous avons plusieurs zones de restauration où vous pouvez acheter des repas, des collations et des boissons tout au long de votre visite.</div>
    </div>

    <div class="faq-item">
        <div class="question">Puis-je venir avec mon animal de compagnie ?</div>
        <div class="answer">Pour des raisons de sécurité, les animaux de compagnie ne sont pas autorisés dans le zoo, à l'exception des chiens-guides pour les personnes malvoyantes.</div>
    </div>

    <div class="faq-item">
        <div class="question">Le parking est-il gratuit ?</div>
        <div class="answer">Oui, le Zoo de la Barben dispose d'un parking gratuit pour tous les visiteurs.</div>
    </div>

</div>

</body>
</html>
