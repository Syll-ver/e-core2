<?php
//including the database connection file
include('../config/config.php');
 
//getting id of the data from url
$id = urldecode($_GET['id']);

//deleting row from table course_offered
$sql = 'DELETE FROM course_offered WHERE "courseCode"=:id';
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $id));

if($query==true){
	header("Location: ../courseOffers.php");
} else {
	echo "<script> alert('error');</script>";
}
 
//redirecting to the display page (index.php in our case)

?>