<?php
// configuration
include('../config/config.php');

// new data
$name = $_POST['adminName'];
$username = $_POST['adminUser'];
$id = $_POST['id'];
$role = $_POST['roleselect'];
$dept = $_POST['dept'];

// query
if($role == 'admin'){
  $result = $pdo->prepare('SELECT *
                            FROM accounts
                            WHERE "id" = :id');
  $result->bindParam(':id', $id);
  $result->execute();
  $row = $result->fetch();

  	$sql = 'CALL "editaccounttoadm"(:id, :username1, :usernamu);';
	$q = $pdo->prepare($sql);
	$q->execute(array(':id'=>$id, ':username1'=>$row['username'],':usernamu'=>$username));
	header("location: ../accounts.php?acc=adm");
} else if ($role == 'chairperson'){
	$result = $pdo->prepare('SELECT *
                            FROM accounts
                            WHERE "id" = :id');
  $result->bindParam(':id', $id);
  $result->execute();
  $row = $result->fetch();

	$sql = 'CALL "editaccounttochair"(:id, :username, :dept, :name);';
	$q = $pdo->prepare($sql);
	$q->execute(array(':id'=>$id, ':usernamu'=>$username, ':dept'=>$dept, ':name'=>$row['name']));
	header("location: ../accounts.php?acc=adm");

}

$sql = "UPDATE accounts 
        SET \"name\"=?, \"username\"=?, role=?
		WHERE \"admin_id\"=?";
$q = $pdo->prepare($sql);
$q->execute(array($name,$username,$role,$id));
header("location: ../accounts.php");

?>