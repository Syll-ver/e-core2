<?php
include('../config/config.php');	

$name = $_POST['adminName'];
$username = $_POST['adminUser'];
$password = md5($_POST['password']);
$role = $_POST['role'];
$dept = $_POST['dept'];

if($role == 'admin'){
	// query
	$sql = 'CALL "newAdminAcc"(:username, :password, :role, :name);';
	$q = $pdo->prepare($sql);
	$q->execute(array(':username'=>$username,':password'=>$password,':role'=>$role,':name'=>$name));
	header("location: ../accounts.php?acct=adm");
} else if($role == 'chairperson'){
	$sql = 'CALL "newChairAcc"(:username, :password, :role, :dept, :name);';
	$q = $pdo->prepare($sql);
	$q->execute(array(':username'=>$username,':password'=>$password,':role'=>$role, ':dept'=>$dept, ':name'=>$name));
	header("location: ../accounts.php?acct=chr");
	
}

?>