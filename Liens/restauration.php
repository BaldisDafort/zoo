<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauration - Zoo de la Barben</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" rel="stylesheet">
    <LINK href="../mes_styles.css" rel="stylesheet" type="text/css">
    <style>
        /* Styles de base */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }
        h1 {
            margin: 0;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem;
        }
        .intro {
            text-align: center;
            margin: 2rem 0;
        }
        .menu-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .menu-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            margin: 1rem;
            padding: 1rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .menu-item img {
            width: 100%;
            border-radius: 8px;
        }
        .menu-item h3 {
            color: #333;
            margin: 1rem 0 0.5rem;
        }
        .menu-item p {
            color: #555;
            font-size: 0.9rem;
        }
        .cta-button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 0.7rem 1.5rem;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1rem;
            transition: background-color 0.3s;
        }
        .cta-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>Restauration - Zoo de la Barben</h1>
</header>

<div class="container">
    <div class="intro">
        <p>Bienvenue dans notre espace restauration ! Découvrez nos différentes options de restauration rapide pour satisfaire toutes les envies pendant votre visite au Zoo de la Barben.</p>
    </div>

    <div class="menu-section">
        <!-- Burger Section -->
        <div class="menu-item">
            <img src="./images/burger.jpeg" alt="Burgers">
            <h3>Burgers</h3>
            <p>De délicieux burgers faits maison, accompagnés de frites croustillantes et de boissons fraîches.</p>
            <a href="#reserver"  >  </a>
        </div>

        <!-- Pizza Section -->
        <div class="menu-item">
            <img src="./images/pizza.avif" alt="Pizzas">
            <h3>Pizzas</h3>
            <p>Choisissez parmi nos pizzas classiques et originales, préparées avec des ingrédients frais.</p>
            <a href="#reserver"  >  </a>
        </div>

        <!-- Snacks Section -->
        <div class="menu-item">
            <img src="./images/snacks.avif" alt="Snacks">
            <h3>Snacks</h3>
            <p>Snacks variés, allant des nuggets aux frites, parfaits pour un encas rapide et savoureux.</p>
            <a href="#reserver"  >  </a>
        </div>

        <!-- Boissons Section -->
        <div class="menu-item">
            <img src="./images/boisson.jpg" alt="Boissons">
            <h3>Boissons</h3>
            <p>Une sélection de boissons rafraîchissantes, jus de fruits, sodas et eaux minérales.</p>
            <a href="#reserver"  >  </a>
        </div>
    </div>
</div>

</body>
</html>
