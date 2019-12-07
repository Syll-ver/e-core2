<?php
include('../../config/config.php');
$id = urldecode($_GET['id']);
$sql = ("UPDATE reservation SET \"status\"='enrolled' WHERE \"student_id\" = :id");
$d = $pdo->prepare($sql);
$d->execute(array(':id'=>$id));
header("location: ../index.php");
?>