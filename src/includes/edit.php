<?php
	
	$error_messages = array();
	// Get name of product
	$_name = $_GET['name'];

	if ((isset($_POST['formedit']))) 
	{
		//Get _POST
		$name = htmlspecialchars($_POST['name']);
		$ref = htmlspecialchars($_POST['ref']);
		$price_ttc = htmlspecialchars($_POST['price_ttc']);
		$price_ht = htmlspecialchars($_POST['price_ht']);
		$amount = htmlspecialchars($_POST['amount']);
		$notes = htmlspecialchars($_POST['notes']);

		// Check image
		if (!($_FILES['image_upload']['error'] == '4')) 
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
			
			// Nice situation    
		    if (empty($error_messages)) 
		    {
			   	$img_name = "./assets/img/{$_FILES['image_upload']['name']}";
		    	$resultat = move_uploaded_file($_FILES['image_upload']['tmp_name'],$img_name);

			    $req_product = $pdo->prepare('UPDATE product set image=:image WHERE name="'.$_name.'"');
			    $req_product->bindValue('image', $img_name);
			    $req_product->execute() OR die('Erreur, recommencer la requéte');
		    }

		}
		
		// Nice situation
		if (empty($error_messages)) 
		{
			// upload update on serveur
			$req_product = $pdo->prepare('UPDATE product set name=:name, ref=:ref, amount=:amount, price_ht=:price_ht, price_ttc=:price_ttc, notes=:notes WHERE name="'.$_name.'"');
			$req_product->bindValue('name', $name);
			$req_product->bindValue('ref', $ref);
			$req_product->bindValue('amount', $amount);
			$req_product->bindValue('price_ht', $price_ht);
			$req_product->bindValue('price_ttc', $price_ttc);
			$req_product->bindValue('notes', $notes);
			$req_product->execute() OR die('Erreur, recommencer la requéte');
			header('Location: ./home.php');
		}
	}