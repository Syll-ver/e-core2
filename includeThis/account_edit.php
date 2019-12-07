<?php
// configuration
include('../config/config.php');

// new data
$id = $_POST['id'];
$email = $_POST['email'];
$name = $_POST['adminName'];
$username = $_POST['adminUser'];
$role = $_POST['role'];
$password = $_POST['password'];
$confpassword = $_POST['confpassword'];

	//query to select admin_id in order to use that for updating admin details in admin table which is separate from accounts table
	$my = $pdo->query("SELECT admin_id FROM admin JOIN accounts USING (username) WHERE id ='".$id."';");
	$row = $my->fetch(PDO::FETCH_ASSOC);
	//$admin_id = $row['admin_id'];

if($password == $confpassword){
	$sql = "UPDATE accounts set username = ?, password = ?, role = ?
			WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($username, md5($confpassword), $role, $id));

	

	$sql2 = "UPDATE admin set name = ? username = ?, email = ? 
			WHERE admin_id = ?";
	$q2 = $pdo->prepare($sql);
	$q2->execute(array($name, $username, $email, $row['admin_id']));

	header("location: ../admin.php");
}


//working pero dili mag change ang coursecode kay maglibog pa unsa nga coursecode ang gamiton sa where coursecode = ? if ang old or ang bago

?>