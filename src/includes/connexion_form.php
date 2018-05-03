<?php

    if (isset($_SESSION[''])) {
    	# code...
    }


    if(isset($_POST['form_connexion'])) 
    {
		// find value
		$pseudo = htmlspecialchars($_POST['pseudo_connect']);
		$mdp = sha1($_POST['mdp_connect']);
		// Condition pseudo
		if(!empty($pseudo) AND !empty($_POST['mdp_connect']))
		{
			$req_user = $pdo->prepare("SELECT * FROM users WHERE pseudo=:pseudo AND mdp=:mdp");
			$req_user->bindValue('pseudo', $pseudo);
			$req_user->bindValue('mdp', $mdp);
			$req_user->execute();
			$req_user = $req_user->fetchAll();
			if ($req_user) {
				session_cache_expire(2);
				$cache_expire = session_cache_expire();
				session_start();
				$_SESSION['pseudo'] = $pseudo;
				header("Location: ./home.php");
				exit();
			}
			else
				$error_messages['null'] = 'Pseudo ou mots de passe incorecte !';
		}
		else	
			$error_messages['empty'] = 'Les cases sont vide ou incomplétes !';
	}