<?php
	include_once('connection.php');

	$output = array('error' => false);

	$database = new Connection();
	$db = $database->open();

	try{
		$code = $_POST['collegeCode'];
		$stmt = $db->prepare("SELECT * FROM college WHERE collegeCode = :code");
		$stmt->bindParam(':code', $code);
		$stmt->execute();
		$output['data'] = $stmt->fetch();
	}
	catch(PDOException $e){
		$output['error'] = true;
		$output['message'] = $e->getMessage();
	}

	//close connection
	$database->close();

	echo json_encode($output);

?>