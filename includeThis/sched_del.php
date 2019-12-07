<?php
include('../config/config.php');	

$id = $_GET['id'];

	// query
$sql = 'DELETE FROM score_schedule WHERE id = :id';
	$q = $pdo->prepare($sql);
	$q->execute(array(':id'=>$id));

header("location: ../index.php");

?>