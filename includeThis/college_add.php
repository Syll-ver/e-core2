<?php
include('../config/config.php');	

$collegeCode = $_POST['code'];
$collegeName = $_POST['name'];

	//query to check for duplicate
	// $sql1 = $pdo->prepare("SELECT * FROM college WHERE \"collegeCode\" = :code AND \"collegeName\" = :name");
	// $sql1->execute(array(':code'=>$collegeCode, ':name'=>$collegeName));
	// $col = $sql1->fetch();

	//CAN U MAKE STORED FUNCTION ON RETURNING FALSE IF MAY DUPLICATE. AND RETURNING LIKE TRUE IF SUCCESSFUL INSERT
	// if(!empty($col)){
	// 	//$querystring = urldecode(http_build_query(array('doppelte', $collegeName)));

	// 	if($col["collegeCode"] == $collegeCode || $col['collegeName'] == $collegeName){
	// 		header("location: ../college.php");
	// 	}
	// 	if($col["collegeCode"] == $collegeCode && $col['collegeName'] == $collegeName){
	// 		header("location: ../college.php");
	// 	}

	// 	//what if isahon nako like if(($col["collegeCode"] == $collegeCode && $col['collegeName'] == $collegeName) || ($col["collegeCode"] == $collegeCode || $col['collegeName'] == $collegeName)) ang condition? make try later
	// } else{
	
		$sql = "INSERT INTO college (\"collegeCode\", \"collegeName\") VALUES (:code,:name)";
		$q = $pdo->prepare($sql);
		$q->execute(array(':code'=>$collegeCode,':name'=>$collegeName));

		//$querystring = urldecode(http_build_query(array('hinzugeben', $collegeName)));
//$message = "wrong answer";

		//echo json_encode($q);
	if ($q->rowCount() > 0){
		echo json_encode(true);
	} else {
		$error = $q->errorInfo();
		echo json_encode($error);
	}
		

		//header('Refresh:1; url=../college.php');
		//echo "<script type='text/javascript'>alert('you have successfully added $collegeCode: $collegeName');</script>";
	//}


?>