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
	    <title>GestionApp - connexion</title>
	    <link rel="stylesheet" href="assets/css/app.css">
	    <link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,500" rel="stylesheet">
	</head>
	<body>
	    <div class="background">
	        <div class="container">
	            <h1 class="title">Gestion app</h1>
	            <form class="box-login" action="#" method="post">
	                <legend>Connexion</legend>
	                <div class="mails content-input">
	                    <table>
	                        <tr>
	                            <td>
	                                <label for="pseudo_connect" class="title-inuput">Pseudo</label>
	                            </td>
	                            <td>
	                                <div class="error_messages">
	                                </div>
	                            </td>
	                        </tr>
	                    </table>
	                    <input type="text" name="pseudo_connect" placeholder="Pseudo">
	                </div>
	                <div class="mdp content-input">
	                    <label for="mdp_connect" class="title-inuput">Mots de passe</label>
	                    <input type="password" name="mdp_connect" placeholder="Mots de passe">
	                </div>
	                <div class="error_messages">
	                    <?php if (!empty($error_messages['empty'])){echo $error_messages['empty'];} ?>
	                    <?php if (!empty($error_messages['null'])){echo $error_messages['null'];} ?>
	                </div>
	                <div class="buttons">
						<a href="./inscription.php" class="connexion btn-inscription">Inscription</a>
	                    <input type="submit" value="Connexion" class="connexion" name="form_connexion">
	                </div>
	            </form>
	        </div>
	    </div>
	    <script src="assets/js/app.js"></script>
	</body>
</html>