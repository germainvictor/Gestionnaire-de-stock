<?php 
    include 'includes/config.php';
    include 'includes/connexion_form.php';

    // get db users
    $query = $pdo->query('SELECT * FROM users');
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>GestionApp - inscription</title>
		<link rel="stylesheet" href="assets/css/app.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,500" rel="stylesheet">
	</head>
	<body>
		<div class="background">
			<div class="container-inscription">
				<h1 class="title">Gestion app</h1>	
				<form class="box-inscription" action="" method="post">
			        <legend>Inscription</legend>
				    <div class="pseudo content-input">
						<table>
							<tr>
						        <td>
						        	<label for="pseudo" class="title-inuput <?=array_key_exists('pseudo', $error_messages) ? 'error' : ''?>">Pseudo</label>
						        </td>
						        <td>
						        	<div class="error_messages"><?php if (!empty($error_messages['pseudo'])){echo $error_messages['pseudo'];} ?></div>
								</td>
							</tr>
						</table>
				        <input type="text" name="pseudo" placeholder="Pseudo" value="<?php if (isset($_POST['pseudo'])){echo $_POST['pseudo'];} ?>">
				    </div>
				    <div class="mail content-input ">
				        <table>
				        	<tr>
				        		<td>
						        	<label for="mail" class="title-inuput <?=array_key_exists('mail', $error_messages) ? 'error' : ''?>">Mail</label>
						        </td>
						        <td>
						        	<div class="error_messages"><?php if (!empty($error_messages['mail'])){echo $error_messages['mail'];} ?></div>
				        		</td>
				        	</tr>
				        </table>
				        <input type="mail" name="mail" placeholder="Mail" value="<?php if (isset($_POST['mail'])){echo $_POST['mail'];} ?>">
			        </div>
				    <div class="mail2 content-input">
				        <table>
				        	<tr>
				        		<td>
				        			<label for="mail2" class="title-inuput <?=array_key_exists('mail', $error_messages) ? 'error' : ''?>">Confirmation du mail</label>
								</td>
							</tr>
						</table>				        
				        <input type="mail" name="mail2" placeholder="Confirmation mail" value="<?php if (isset($_POST['mail2'])){echo $_POST['mail2'];} ?>">
			        </div>
			        <div class="mdp content-input">
			        	<table>
			        		<tr>
			        			<td>
							    	<label for="mdp" class="title-inuput <?=array_key_exists('mdp', $error_messages) ? 'error' : ''?>">Mots de passe</label>
							    </td>
							    <td>
							    	<div class="error_messages"><?php if (!empty($error_messages['mdp'])){echo $error_messages['mdp'];} ?></div>
					    		</td>
					    	</tr>
					    </table>
					    <input type="password" name="mdp" id="mdp" placeholder="Mots de passe">
				    </div>
			        <div class="mdp2 content-input">
					    <table>
					    	<tr>
					    		<td>
					    			<label for="mdp2" class="title-inuput <?=array_key_exists('mdp', $error_messages) ? 'error' : ''?>">Confirmation mots de passe</label>
					    		</td>
					    	</tr>
					    </table>
					    <input type="password" name="mdp2" placeholder="Confirmation mots de passe">
				    </div>
				    <input type="submit" name="forminscription" value="Inscription" class="inscription">
				</form>	
			</div>
		</div>
		<script src="assets/js/app.js"></script>
	</body>
</html>