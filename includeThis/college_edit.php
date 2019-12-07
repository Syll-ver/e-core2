<?php
// configuration
include('../config/config.php');

// new data
$collegeCode = $_POST['code'];
$collegeName = $_POST['name'];
$oldcollcode = $_POST['oldcode'];

 $response = array();
// query
$sql = "UPDATE college 
        SET \"collegeCode\"=?, \"collegeName\"=?
		WHERE \"collegeCode\"=?";
$q = $pdo->prepare($sql);
//$q->execute(array($collegeCode,$collegeName,$oldcollcode));

if ($q->execute(array($collegeCode,$collegeName,$oldcollcode)) == false) {
		$response['status']  = 'error';
		$response['message'] = 'Unable to update college ...';
} else if ($q->execute(array($collegeCode,$collegeName,$oldcollcode)) == true) {
		$response['status']  = 'success';
		$response['message'] = 'Successfully updated college ...';
}
		echo json_encode($response);
//echo json_encode($q);

//header("location: ../college.php");

?>