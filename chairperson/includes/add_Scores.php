<?php
include("../../config/config.php");	

  $academicYear = $_POST['ay'];
  $courseCode = $_POST['courseCode'];
  $GRcriteria = $_POST['GRcriteria'];
  $AP = $_POST['AP'];
  $LU = $_POST['LU'];
  $MA = $_POST['MA'];
  $SC = $_POST['SC'];
  $Slot = $_POST['Slot'];



 $sql = "INSERT INTO course_offered(\"acadYear\", \"courseCode\",\"GR_criteria\",\"AP\",\"LU\",\"MA\",\"SC\",\"slot\") VALUES(:academicYear,:courseCode,:GRcriteria,:AP,:LU,:MA,:SC,:Slot)";
 $q = $pdo->prepare($sql);
 $q->execute(array(':academicYear' => $academicYear,':courseCode' => $courseCode,':GRcriteria'=> $GRcriteria,':AP' => $AP,':LU' => $LU,':MA' => $MA,':SC' => $SC, ':Slot' => $Slot));
 header("location: ../index.php");
 
