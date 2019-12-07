<?php
include('../config/config.php');	

$acadyear = $_POST['ay'];
$start = $_POST['start'];
$end = $_POST['end'];
$status = $_POST['status'];

	// query
	$sql = 'INSERT INTO academic_year("acadYear", "reservationStart", "reservationEnd", "status")
				VALUES(:acadyear, :res_start, :res_end, :status);';
	$q = $pdo->prepare($sql);
	$q->execute(array(':acadyear'=>$acadyear,':res_start'=>$start,':res_end'=>$end,':status'=>$status));

header("location: ../index.php");

?>