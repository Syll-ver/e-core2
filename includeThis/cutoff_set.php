<?php
include('../config/config.php');	

$username = $_POST['username'];
$course = $_POST['course'];
$gr = $_POST['GR'];
$ap = $_POST['AP'];
$lu = $_POST['LU'];
$ma = $_POST['MA'];
$sc = $_POST['SC'];
$slot = $_POST['slot'];


// query to get active acad year and deptcode
$acad = $pdo->query("SELECT \"acadYear\", \"deptCode\"
						FROM course_offered
						JOIN course USING (\"courseCode\")
						JOIN department USING (\"deptCode\")
						JOIN academic_year USING (\"acadYear\")
						WHERE status = true AND \"courseCode\" = :code");
$acad->execute(array(':code'=>$course));
$row = $acad->fetch(PDO::FETCH_ASSOC);

//query select deptcode from department based on user chosen course code
// $deptCode = $pdo->query("SELECT \"deptCode\"
// 							FROM department
// 							JOIN course USING (\"deptCode\")
// 							WHERE \"courseCode\" = '".$course."';");
// $dept = $deptCode->fetch(PDO::FETCH_ASSOC);

$sql = "CALL \"adminSetCutOff\"(:ay, :coursecode, :gr, :ap, :lu, :ma, :sc, :slot, :username, :dept); ";
$q = $pdo->prepare($sql);
$q->execute(array(':ay'=>$row['acadYear'], ':coursecode'=>$course, ':gr'=>$gr,':ap'=>$ap,':lu'=>$lu, ':ma'=>$ma, ':sc'=>$sc, ':slot'=>$slot, ':username'=>$username, , ':dept'=>$row['deptCode']));

header("location: ../courseOffers.php");



?>