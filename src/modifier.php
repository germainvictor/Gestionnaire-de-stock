<?php 

    include 'includes/connexion_form.php';
    session_start();
    if (empty($_SESSION['pseudo'])) {
        header('Location: ./connexion.php');
    }

    include 'includes/config.php';
    include 'includes/add_product.php';
    include 'includes/edit.php';

    $name = $_GET['name'];
    // get db product
    $query = $pdo->query('SELECT * FROM product WHERE name="'.$name.'"');
    $product_select = $query->fetchAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GestionApp - Ajouter</title>
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
        <h2 class="title-enter">Modifier : <?= $name ?></h2>
        <div class="content-add">
            <form class="box-add" action="" method="post" enctype="multipart/form-data">
                <div class="field">
		            <div class="content-input">
		                <table>
		                    <tr>
		                        <td>
		                            <label for="image_upload" class="title-inuput <?=array_key_exists('file', $error_messages) ? 'error' : ''?>">Image</label>
		                        </td>
		                        <td>
		                            <div class="error_messages">
		                                <?php if (!empty($error_messages['file'])){echo $error_messages['file'];} ?>
		                            </div>
		                        </td>
		                    </tr>
		                </table>
		                <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
		                <input type="file" name="image_upload" value="<?= $product_select['0']->image ?>">
		            </div>
		            <div class="content-input">
		                <table>
		                    <tr>
		                        <td>
		                            <label for="name" class="title-inuput <?=array_key_exists('name', $error_messages) ? 'error' : ''?>">Nom</label>
		                        </td>
		                        <td>
		                            <div class="error_messages">
		                                <?php if (!empty($error_messages['name'])){echo $error_messages['name'];} ?>
		                            </div>
		                        </td>
		                    </tr>
		                </table>
		                <input value="<?= $product_select['0']->name ?>" type="text" name="name" placeholder="Nom">
		            </div>
		            <div class="content-input">
		                <table>
		                    <tr>
		                        <td>
		                            <label for="ref" class="title-inuput <?=array_key_exists('ref', $error_messages) ? 'error' : ''?>">Ref</label>
		                        </td>
		                        <td>
		                            <div class="error_messages">
		                                <?php if (!empty($error_messages['ref'])){echo $error_messages['ref'];} ?>
		                            </div>
		                        </td>
		                    </tr>
		                </table>
		                <input value="<?= $product_select['0']->ref?>" type="text" name="ref" placeholder="Ref">
		            </div>
		            <div class="content-input">
		                <table>
		                    <tr>
		                        <td>
		                            <label for="price_ttc" class="title-inuput <?=array_key_exists('price_ttc', $error_messages) ? 'error' : ''?>">Prix TTC</label>
		                        </td>
		                        <td>
		                            <div class="error_messages">
		                                <?php if (!empty($error_messages['price_ttc'])){echo $error_messages['price_ttc'];}?>
		                            </div>
		                        </td>
		                    </tr>
		                </table>
		                <input value="<?= $product_select['0']->price_ttc ?>" type="text" name="price_ttc" placeholder="Pric TTC">
		            </div>
		            <div class="content-input">
		                <table>
		                    <tr>
		                        <td>
		                            <label for="price_ht" class="title-inuput <?=array_key_exists('price_ht', $error_messages) ? 'error' : ''?>">Prix HT</label>
		                        </td>
		                        <td>
		                            <div class="error_messages">
		                                <?php if (!empty($error_messages['price_ht'])){echo $error_messages['price_ht'];} ?>
		                            </div>
		                        </td>
		                    </tr>
		                </table>
		                <input value="<?= $product_select['0']->price_ht?>" type="text" name="price_ht" placeholder="Prix HT">
		            </div>
		            <div class="content-input">
		                <table>
		                    <tr>
		                        <td>
		                            <label for="amount" class="title-inuput <?=array_key_exists('amount', $error_messages) ? 'error' : ''?>">Quantité</label>
		                        </td>
		                        <td>
		                            <div class="error_messages">
		                                <?php if (!empty($error_messages['amount'])){echo $error_messages['amount'];} ?>
		                            </div>
		                        </td>
		                    </tr>
		                </table>
		                <input value="<?= $product_select['0']->amount ?>" type="text" name="amount" placeholder="Quantité">
		            </div>
		            <div class="content-input">
		                <table>
		                    <tr>
		                        <td>
		                            <label for="notes" class="title-inuput">Description</label>
		                        </td>
		                        <td class="no_obligatory">Champ non obligatoire</td>
		                    </tr>
		                </table>
		                <textarea value="" name="notes" placeholder="Description"><?= $product_select['0']->notes ?></textarea>
		            </div>
                </div>
                <input type="submit" name="formedit" value="Confirmer" class="btn-add">
            </form>
        </div>
        <script src="assets/js/app.js"></script>
</body>
</html>