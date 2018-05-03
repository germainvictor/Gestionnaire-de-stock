<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', true);

    session_start();
    if (empty($_SESSION)) {
        header('Location: ./connexion.php');
    }

    include 'includes/config.php';
    include 'includes/add_product.php';
    include 'includes/show_product.php';

    $name = $_GET['name'];
    // get db product
    $query = $pdo->query('SELECT * FROM product WHERE name="'.$name.'"');
    $product_select = $query->fetchAll();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GestionApp - <?= $name ?></title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,500" rel="stylesheet">
</head>

<body>
    <header class="header">
        <li class="">Bonjour
            <b><?= $_SESSION['pseudo'] ?></b>
        </li>
        <li class="logo"><a href="./home.php">Accueil</a></li>
        <li class="logo"><a href="./ajouter.php">Ajouter produits</a></li>
        <li class="deconnexion"><a href="./deco.php">Déconnexion</a></li>
    </header>
    <div class="content-title">
        <h2 class="title-enter"> <?= $name ?></h2>
	        <div class="content-show">
	        <?php foreach($product_select as $_product_select){ ?>
					<img src="<?= $_product_select->image ?>" alt="Image manquante">
					<div class="content_product">
						<div class="ref"> <b>Ref</b> : <?= $_product_select->ref ?> </div>
						<div class="amount"> <b>Quantité</b> : <?= $_product_select->amount ?> </div>
						<div class="price_ht"> <b>Prix HT</b> : <?= $_product_select->price_ht ?> €</div>
						<div class="price_ttc"> <b>Prix TTC</b> : <?= $_product_select->price_ttc ?> €</div>
						<div class="notes"> <b>Description</b> : <?= $_product_select->notes ?> </div>
					</div>
			<?php } ?>
			<div class="buttons">
				<a href="home.php" class="connexion">Retour</a>
				<a href="modifier.php?name=<?= $name ?>" class="connexion">Modifier</a>
		    </div>
        </div>
    </div>

        <script src="assets/js/app.js"></script>
</body>

</html>