<?php

require_once('db_connect.php');
function is_valid_email($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

$errors="";

/*$password = strip_tags(trim($_POST['password']));
md5($password);*/

//form processing
if($_POST) {
	// nettoyage
	$name = strip_tags(trim($_POST['name']));
	$firstname = strip_tags(trim($_POST['firstname']));
	$username = strip_tags(trim($_POST['username']));
	$password = strip_tags(trim($_POST['password']));
	$favorite_player = strip_tags(trim($_POST['favorite_player']));
	$email = strip_tags(trim($_POST['email']));
	$confirm_email = strip_tags(trim($_POST['confirm_email']));
	
	if($name == '') {
		$errors = "name";
	}
	if($firstname == '') {
		$errors = "firstname";
	}
	if($username == '') {
		$errors = "username";
	}
	if($password == '') {
		$errors = "password";
	}
	if(is_valid_email($email) == false) {
		$errors = "email";
	}
	if($email != $confirm_email) {
		$errors = "confirm email";
	}
	
	if($errors == "")
	{
		$query = 'INSERT INTO users_scbc (name,firstname,username,password,favorite_player,email,confirm_email) VALUES (:name,:firstname,:username, :password, :favorite_player, :email, :confirm_email);';
			$preparedStatement = $dbh->prepare($query);
			$preparedStatement->bindParam(":name", $name);
			$preparedStatement->bindParam(":firstname", $firstname);
			$preparedStatement->bindParam(":username", $username);
			$preparedStatement->bindParam(":password", $password);
			$preparedStatement->bindParam(":favorite_player", $favorite_player);
			$preparedStatement->bindParam(":email", $email);
			$preparedStatement->bindParam(":confirm_email", $confirm_email);
			$preparedStatement->execute();
			header("Location: public.php");
	}
	else{
		die($errors);
	}
}
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Inscription</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
</head>
<body>
<div class="container">
	<header>
		<h1>Inscription</h1>
	</header>
	<div class="content">
		<form action="" method="post">
			<fieldset>
				<ul>
					<li><label class="disappear" for="name">Nom</label><input id="name" type="text" name="name" placeholder="Nom..."/></li>
					<li><label class="disappear" for="firstname">Prénom</label><input id="firstname" type="text" name="firstname" placeholder="Prénom..."/></li>
					<li><label class="disappear" for="username">Nom d'utilisateur</label><input id="username" type="text" name="username" placeholder="Nom d'utilisateur..."/></li>
					<li><label class="disappear" for="password">Mot de passe</label><input id="password" type="password" name="password" placeholder="Mot de passe..."/></li>
					<li><label class="disappear" for="favorite_player">Joueur préféré</label><input id="favorite_player" type="text" name="favorite_player" placeholder="Joueur préféré..."/></li>
					<li><label class="disappear" for="email">Adresse e-mail</label><input id="email" type="email" name="email" placeholder="Adresse e-mail..."/></li>
					<li><label class="disappear" for="confirm_email">Confirmation e-mail</label><input id="confirm_email" type="email" name="confirm_email" placeholder="Confirmation e-mail..."/></li>
					<li><input id="submit" type="submit" value="S'inscrire" name="inscription"/></li>
				</ul>
			</fieldset>
		</form>
	</div>
</div>
</body>
</html>