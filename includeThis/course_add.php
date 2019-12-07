<?php
include('../config/config.php');	

$coursecode = $_POST['coursecode'];
$coursename = $_POST['coursename'];
$dept = $_POST['dept'];
$strand = $_POST['strand'];

// query
$sql = "INSERT INTO course (\"courseCode\", \"courseName\", \"deptCode\", \"strand\") VALUES (:code,:name,:department,:track)";
$q = $pdo->prepare($sql);
$q->execute(array(':code'=>$coursecode,':name'=>$coursename,':department'=>$dept,':track'=>$strand));
header("location: ../course.php");


?>