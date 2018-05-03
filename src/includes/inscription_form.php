<?php

	$error_messages = array();
	$success_messages = array();


    if(isset($_POST['forminscription'])) 
    {
		// find value
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$mail = htmlspecialchars($_POST['mail']);
		$mail2 = htmlspecialchars($_POST['mail2']);
		$mdp = sha1($_POST['mdp']);
		$mdp_check = strlen($_POST['mdp']);
		$mdp2 = sha1($_POST['mdp2']);

		// Condition pseudo
		if(!empty($pseudo))
		{
			$pseudo_lenght = strlen($pseudo);
			if ($pseudo_lenght < 255) 
			{
				$req_pseudo = $pdo->prepare("SELECT * FROM users WHERE pseudo = ?");
				$req_pseudo->execute(array($pseudo));
				$pseudo_exist = $req_pseudo->rowCount();
				if($pseudo_exist >= 1) 
				{
					$error_messages['pseudo'] = 'Ce pseudo existe déja';
				}
			}
			else 
				$error_messages['pseudo'] = 'Pseudo trop grand (255 caractéres max)';
		}
		else	
			$error_messages['pseudo'] = 'Case vide';

		// condtion mail 
		if(!empty($mail)) 
		{
			if ($mail == $mail2) 
			{
				if(filter_var($mail, FILTER_VALIDATE_EMAIL)) 
				{
					$req_mail = $pdo->prepare("SELECT * FROM users WHERE mail = ?");
					$req_mail->execute(array($mail));
					$mail_exist = $req_mail->rowCount();
					if ($mail_exist >= 1)
					{
						$error_messages['mail'] = 'Adresse mail déja utilisé';
					}
				}
				else
					$error_messages['mail'] = 'Adresse mail non valide';
			}
			else
				$error_messages['mail'] = 'Adresse mail non identique';
		}
		else
			$error_messages['mail'] = 'Case vide';

		// Conditon mdp
		if($mdp_check != '0')
		{
			if ($mdp != $mdp2)
			{
				$error_messages['mdp'] = 'Les mots de passe ne correspondent pas';
			}
		}
		else
			$error_messages['mdp'] = 'Case vide';

		// Send db
		if(empty($error_messages)) 
		{
		    $prepare = $pdo->prepare('INSERT INTO users(pseudo, mail, mdp) 
		    	VALUES(?, ?, ?)');
			$prepare->execute(array($pseudo, $mail, $mdp));

			//succes 
			header('Location: ./connexion.php');

		}
	}