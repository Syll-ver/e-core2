<?php
// configuration
include('../../config/config.php');

// new data

$courseCode = $_POST['courseCode'];
$GRcriteria = $_POST['GRcriteria'];
$AP = $_POST['AP'];
$LU = $_POST['LU'];
$MA = $_POST['MA'];
$SC = $_POST['SC'];
$Slot = $_POST['Slot'];

// query
$sql = " UPDATE cut_off SET \"GR_criteria\" = :GRcriteria,\"AP\" = :AP,\"LU\" = :LU,\"MA\" = :MA,\"SC\" = :SC,\"slot\" = :Slot
FROM 
academic_year,course,chairperson WHERE cut_off.\"acadYear\" = academic_year.\"acadYear\"
AND cut_off.\"courseCode\" ='".$courseCode."' AND academic_year.status= 'true';";
$q = $pdo->prepare($sql);
$q->execute(array(':GRcriteria'=> $GRcriteria,':AP' => $AP,':LU' => $LU,':MA' => $MA,':SC' => $SC, ':Slot' => $Slot));
header("location: ../index.php");

?>