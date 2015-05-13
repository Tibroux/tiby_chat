<?php
require_once('config.inc.php');
$message = strip_tags(trim($_POST['add']));
$user_id = $_SESSION['user'][0]['id'];
if ($_POST) {
	if ($task != NULL) {
		$query = "INSERT INTO messages_scbc(user_scbc_id,message,action) VALUES(:user_scbc_id,:message,:action);";
		$prout = $dbh->prepare($query);
		$prout -> bindParam(":user_scbc_id",$user_scbc_id);
		$prout -> bindParam(":message",$message);
		$prout -> bindParam(":action",$action);
		$prout -> execute();
		header('Location: public.php');
	}
}
?>