<?php
	$error_messages = array();

	if ((isset($_POST['formadd']))) 
	{
		//Get _POST
		$name = htmlspecialchars($_POST['name']);
		$ref = htmlspecialchars($_POST['ref']);
		$price_ttc = htmlspecialchars($_POST['price_ttc']);
		$price_ht = htmlspecialchars($_POST['price_ht']);
		$amount = htmlspecialchars($_POST['amount']);
		$notes = htmlspecialchars($_POST['notes']);

		// Check _POST
		if (empty($_POST['name']))
		{
			$error_messages['name'] = 'Champ vide';
		}	

		if (empty($_POST['ref']))
		{
			$error_messages['ref'] = 'Champ vide';
		}	

		if (empty($_POST['price_ttc']))
		{
			$error_messages['price_ttc'] = 'Champ vide';
		}	

		if (empty($_POST['price_ht']))
		{
			$error_messages['price_ht'] = 'Champ vide';
		}	

		if (empty($_POST['amount']))
		{
			$error_messages['amount'] = 'Champ vide';
		}	

		// Check image
		if ((!empty($_FILES)) AND ($_FILES['image_upload']['error'] === UPLOAD_ERR_NO_FILE)) 
		{
		    // Initialisation
		    $extensions = array('jpg', 'jpeg', 'gif', 'png');
		    $extension  = strtolower(substr(strrchr($_FILES['image_upload']['name'],'.'),1));
		    $img_sizes  = getimagesize($_FILES['image_upload']['tmp_name']);
		    $maxsize    = '2000000';
		    $max_width  = '16000';
		    $max_height = '16000';

		    // Sécurity
		    if ($_FILES['image_upload']['error'] > 0)
		        $error_messages['file'] = 'Erreur lors du transfert';
		    // Size
		    if ($_FILES['image_upload']['size'] > $maxsize)
		        $error_messages['file'] = 'Le fichier est trop gros';
		    // Extension
		    if (!in_array($extension, $extensions))
		        $error_messages['file'] = 'Image non chargée ou Mauvais format';
		    // Dimension
		    if ($img_sizes[0] > $max_width OR $img_sizes[1] > $max_height)
		        $error_messages['file'] = 'Image trop grande';
		}
		// Nice situation
		if (empty($error_messages)) 
		{
			// upload image on serveur
			$img_name = "./assets/img/{$_FILES['image_upload']['name']}";
		    $resultat = move_uploaded_file($_FILES['image_upload']['tmp_name'],$img_name);

		    // Send db
			$req_product = $pdo->prepare("INSERT INTO product (name, ref, amount, price_ht, price_ttc, notes, image) VALUES(:name, :ref, :amount, :price_ht, :price_ttc, :notes, :image)");
			$req_product->bindValue('name', $name);
			$req_product->bindValue('ref', $ref);
			$req_product->bindValue('amount', $amount);
			$req_product->bindValue('price_ht', $price_ht);
			$req_product->bindValue('price_ttc', $price_ttc);
			$req_product->bindValue('notes', $notes);
			$req_product->bindValue('image', $img_name);
			$req_product->execute() OR die('Erreur, recommencer la requéte');
			header('Location: ./home.php');
		}
	}