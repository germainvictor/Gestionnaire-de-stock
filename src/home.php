<?php 
    include 'includes/connexion_form.php';
    session_start();
    if (empty($_SESSION['pseudo'])) {
        header('Location: ./connexion.php');
    }

    include 'includes/config.php';

    // get db users
    $query = $pdo->query('SELECT * FROM product');
    $products = $query->fetchAll();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GestionApp - Home</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,500" rel="stylesheet">
</head>

<body>
    <header class="header">
        <li>Bonjour <b><?= $_SESSION['pseudo'] ?></b></li>
        <li><a href="./home.php">Accueil</a></li>
        <li><a href="./ajouter.php">Ajouter produits</a></li>
        <li class="deconnexion"><a href="./deco.php">Déconnexion</a></li>
    </header>
    <div class="content-title">
        <h2 class="title-enter">Vos produits</h2>
        <div class="content-product">
            <?php foreach($products as $_product){ ?>
                <div class="box-product">
                    <img class="img-product" src="<?= $_product->image ?>" alt="image manquante">
                    <div class="info-product">
                        <div class="name"><?= $_product->name ?></div>
                        <div class="ref">Ref : <?= $_product->ref ?></div>
                        <div class="amount">Quantité : <?= $_product->amount ?></div>
                        <div class="price_ttc">Prix TTC : <?= $_product->price_ttc ?> €</div>
                        <a href="afficher.php?name=<?=$_product->name?>"><div class="show_hover">Afficher</div></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="assets/js/app.js"></script>
</body>

</html>