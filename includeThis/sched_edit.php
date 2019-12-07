<?php
include('../config/config.php');	
$id = $_POST['id'];
$acadyear = $_POST['ay'];
$start = $_POST['beg'];
$end = $_POST['end'];
$sched = $_POST['sched'];

	// query
	$sql = 'UPDATE score_schedule SET "acadYear"=?, "schedule"=?, "scoreStart"=?, "scoreEnd"=?
				WHERE id=?';
	$q = $pdo->prepare($sql);
	$q->execute(array($acadyear, $sched, $start, $end, $id));

header("location: ../index.php");

?>