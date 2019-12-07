<?php
//including the database connection file
include('../config/config.php');
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$sql = 'SELECT * FROM accounts WHERE id=:id';
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $id));
$a = $query->fetch(PDO::FETCH_ASSOC);

if($a['role'] == 'chairperson'){
	$sql = 'DELETE FROM chairperson WHERE "username"=:username';
	$query = $pdo->prepare($sql);
	$query->execute(array(':username' => $a['username']));

	$sql = 'DELETE FROM accounts WHERE "id"=:id';
	$query = $pdo->prepare($sql);
	$query->execute(array(':id' => $id));

} else if($a['role'] == 'admin'){
	$sql = 'DELETE FROM admin WHERE "username"=:username';
	$query = $pdo->prepare($sql);
	$query->execute(array(':username' => $a['username']));

	$sql = 'DELETE FROM accounts WHERE "id"=:id';
	$query = $pdo->prepare($sql);
	$query->execute(array(':id' => $id));
}
 
//redirecting to the display page (index.php in our case)
header("Location: ../accounts.php?del=true");
?>