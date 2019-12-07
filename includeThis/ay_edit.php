<?php
include('../config/config.php');	
$old = $_POST['oldacad'];
$acadyear = $_POST['ay'];
$start = $_POST['start'];
$end = $_POST['end'];
$status = $_POST['status'];

	// query
	if($status == true){
		$sql = 'CALL activateay(:acad, :start, :end)';
		$q = $pdo->prepare($sql);
		$q->execute(array($acadyear, $start, $end));
	} else {
		$sql = 'UPDATE academic_year SET "acadYear" = ?, "reservationStart" = ?, "reservationEnd" = ? WHERE "acadYear" = ? ';
		$q = $pdo->prepare($sql);
		$q->execute(array($acadyear, $start, $end, $old));
	}

header("location: ../index.php?add=true");

?>