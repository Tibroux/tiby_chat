<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=tibyvoesters', 'tibyvoesters', '0DU08s0fsaEGcxEO');
	$dbh->exec('SET CHARACTER SET utf8');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die('connection failed');
}