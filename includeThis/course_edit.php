<?php
// configuration
include('../config/config.php');

// new data
$coursecode = $_POST['coursecode'];
$coursename = $_POST['coursename'];
$dept = $_POST['dept'];
$strand = $_POST['strand'];
$oldcode = $_POST['oldcode'];

// query
$sql = "UPDATE course 
        SET \"courseCode\"=?, \"courseName\"=?, \"deptCode\"=?, strand=?
		WHERE \"courseCode\"=?";
$q = $pdo->prepare($sql);
$q->execute(array($coursecode,$coursename,$dept,$strand,$oldcode));
header("location: ../course.php");

?>