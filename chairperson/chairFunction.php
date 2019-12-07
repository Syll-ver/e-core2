<?php
include_once("config/config.php");

function notifCount($user){
	try{
	    $pdo = new PDO("pgsql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
	    // Set the PDO error mode to exception
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e){
	    die("ERROR: Could not connect. " . $e->getMessage());
	}

	$notifCount = $pdo->query("SELECT COUNT(id) FROM notif WHERE status = '0' AND receiver = '".$chairDept['deptCode']."' ;");
	return $notifCount->fetch(PDO::FETCH_ASSOC);

}


?>