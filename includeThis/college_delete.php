<?php
include('../config/config.php');
	
$response = array();
$id = $_POST['id'];

$sql = 'DELETE FROM college WHERE "collegeCode"=:id';
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $id));

	if ($query) {
		$response['status']  = 'success';
		$response['message'] = 'Product Deleted Successfully ...';
	} else {
		$response['status']  = 'error';
		$response['message'] = 'Unable to delete product ...';
	}
		echo json_encode($response);
?>