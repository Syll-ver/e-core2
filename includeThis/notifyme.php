<?php
include('../config/config.php');	

$username = $_POST['username'];
$title = $_POST['title'];
$body = $_POST['editor'];
//$receiver = $_POST['check_list'];
$tags = $_POST['rec'];
$status = '0';
$date = 'now()';
$action = "add";
$type = "reminder";

$tags_ar = explode(',', $tags);

	for($i = 0; $i < count($tags_ar); $i++){
		$sql = 'INSERT INTO notif ("status", "sender", "receiver", "date", "title", "body", "action", "type") VALUES (:status,:sender,:receiver,:dateniya,:title,:body,:action,:type)';
		$q = $pdo->prepare($sql);
		$q->execute(array(':status'=>$status,':sender'=>$username,':receiver'=>$tags_ar[$i],':dateniya'=>$date,':title'=>$title,':body'=>$body,':action'=>$action,':type'=>$type));
	}

header("location: ../notification.php");

?>