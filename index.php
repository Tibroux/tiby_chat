<?php
require_once 'config.inc.php';


if($_SESSION['logged_in'] != 'ok'){

	if(isset($_POST['connexion'])){
		
		//sanatisation
		$username = trim(strip_tags($_POST['username']));
		$password = trim(strip_tags($_POST['password']));
		$errors = array();
		
		//validation (si username est vide, on affiche error. Si password est vide, de même.)
		
		if( $username == '') {
            $errors['username'] = 'Nom d\'utilisateur ?';
        }
    	if ( $password == '') {
			$errors['password'] = 'Mot de passe ?';
    	}
    
		// Si pas d'erreurs, on vérifie s'il existe dans la DB
    	if(count($errors) < 1 ) {
        
			// Pour chaque tableau User où l'on définit $user, on vérifie si la clé username et password correspond a ce qui a été envoyé en $_POST.
			$sql= "SELECT * FROM users_scbc WHERE username =? && password =?";
			// echo $sql;
			$sth = $dbh->prepare($sql);
			$sth->execute(array($username, $password));
			$user = $sth->fetchAll(PDO::FETCH_ASSOC);
			
			$_SESSION['user'] = $user;
			$_SESSION['logged_in'] = 'ok';
			//print_r($_SESSION);
			header('Location: public.php');
			die("trololol");
			exit;
		} else {
			$errors['resultat'] = 'Nom d\'utilisateur introuvable...';
		}
	die("formulaire posté mais rien");
	}
} else{
	header('Location: public.php');
	exit;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>SC!BC</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
</head>
<body>
<div class="container">
	<header>
		<h1>SC!BC</h1>
	</header>
	<div class="content">
		<form action="" method="post">
			<fieldset>
				<ul>
					<li><label class="disappear" for="username">Nom d'utilisateur</label><input id="username" type="text" name="username" placeholder="Nom d'utilisateur..."/>
					<?php echo message_erreur($errors, 'username');?></li>
					<li><label class="disappear" for="password">Mot de passe</label><input id="password" type="password" name="password" placeholder="Mot de passe..."/>
					<?php echo message_erreur($errors, 'password');?></li>
					<li class="forget"><a href="#">(<span>Mot de passe oublié ?</span>)</a></li>
					<li><input id="submit" type="submit" value="Connexion" name="connexion"/></li>
					<li class="inscription"><a href="inscription.php">S'inscrire</a></li>
				</ul>
			</fieldset>
		</form>
	</div>
</div>
</body>
</html>