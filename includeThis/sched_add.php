<?php
include('../config/config.php');	

$acadyear = $_POST['ay'];
$start = $_POST['beg'];
$end = $_POST['end'];
$sched = $_POST['sched'];

	// query
$sql = 'INSERT INTO score_schedule("scoreStart", "scoreEnd", "schedule", "acadYear")
				VALUES(:start, :end, :sched, :ay);';
	$q = $pdo->prepare($sql);
	$q->execute(array(':start'=>$start,':end'=>$end,':sched'=>$sched,':ay'=>$acadyear));

header("location: ../index.php");

?>