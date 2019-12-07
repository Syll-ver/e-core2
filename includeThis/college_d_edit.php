<?php
// configuration
include('../config/config.php');

// new data
$deptcode = $_POST['deptcode'];
$deptname = $_POST['deptname'];
$college = $_POST['college'];
$oldcode = $_POST['oldcode'];

// query
$sql = 'UPDATE department 
        SET "deptCode"=?, "deptName"=?, "collegeCode" =?
		WHERE "deptCode"=?';
$q = $pdo->prepare($sql);
$q->execute(array($deptcode,$deptname,$college,$oldcode));
header("location: ../department.php");

?>