<?php
include('../config/config.php');	

//select currently active acad_year
$sql1 = "SELECT \"acadYear\" FROM academic_year WHERE status = true";
$q1 = $pdo->prepare($sql1);
$q1->execute();
$ay = $q1->fetch();

if(!empty($_POST['check_list'])){
	$checked_count = count($_POST['check_list']);
	foreach($_POST['check_list'] as $selected){
		$sql = 'INSERT INTO course_offered ("acadYear", "courseCode") VALUES (:ay,:code)';
		$q = $pdo->prepare($sql);
		$q->execute(array(':ay'=>$ay['acadYear'],':code'=>$selected));
	}

}
header("Location: ../courseOffers.php");

?>