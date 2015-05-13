<?php
die("c'est pas là");
require_once('config.inc.php');
// vérifier s'il est loggué
if($_SESSION['logged_in'] != 'ok') {
	header('Location: index.php');
	exit;
}
// nom d'utilisateur
$name= "SELECT * FROM users_scbc WHERE id=:id;";
$u=$dbh->prepare($name);
$u->bindParam(":id",$_SESSION['user'][0]['id']);
$u->execute();
$usernamedb=$u->fetchAll(PDO::FETCH_ASSOC);
//var_dump($_SESSION);
//var_dump($usernamedb);
$sql= "SELECT messages_scbc.id,messages_scbc.public,messages_scbc.user_id FROM messages_scbc LEFT JOIN users_scbc ON users_scbc.id= messages_scbc.user_id WHERE user_id = :tadaa";
//echo $sql;

$q =  $dbh ->prepare($sql);
$q -> bindParam(":tadaa",$_SESSION['user'][0]['id']);
$q -> execute();
$messages_scbc = $q->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Public</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
</head>
<body>
<div class="container">
	<header>
		<h1>Public</h1>
	</header>
	<div class="content">
		<div class="conversation">
			<ul>
			<?php
						foreach ($messages_scbc as $keys=>$t){
	?>
				<li class="user"></li>
				<li class="time"></li>
				<li class="word"><?php echo $t['public']; ?></li>
			</ul>
		</div>
		<form class="send" action="post_message.php" method="post">
			<fieldset>
				<ul>
					<li class="envoyeur"><span>Moi :</span><textarea name="message" id="message"></textarea></li>
					<li class="goal"><input id="goal" type="submit" value="Goal" name="goal"/></li>
				</ul>
			</fieldset>
		</form>
	</div>
</div>
</body>
</html>