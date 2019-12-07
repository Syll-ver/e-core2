<?php
include('../config/config.php');	

$ay = urldecode($_GET['id']);

	// query
	$sql = 'DELETE FROM academic_year WHERE "acadYear" = :ay;';
	$q = $pdo->prepare($sql);
	$q->execute(array(':ay'=>$ay));

header("location: ../index.php");

?>