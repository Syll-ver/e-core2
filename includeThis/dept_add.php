<?php
include('../config/config.php');	

$college = $_POST['college'];
$deptCode = $_POST['code'];
$deptName = $_POST['name'];

// query
if($college != ""){
	$sql = "INSERT INTO department (\"collegeCode\", \"deptCode\", \"deptName\") VALUES (:college, :code,:name)";
	$q = $pdo->prepare($sql);
	$q->execute(array(':college'=>$college,':code'=>$deptCode, ':name'=>$deptName));
	header("location: ../department.php");
}

