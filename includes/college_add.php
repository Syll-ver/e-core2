<?php
include('../config/config.php');	

//  $collegecode = $_POST['collegecode'];
//  $collegename = $_POST['collegename'];
 
// $data = array(
//     ':collegecode' => $collegecode,
//     ':collegename' => $collegename
// );

// foreach($data as $row){
// $sql = "INSERT INTO college (\"collegeCode\", \"collegeName\") VALUES(:datas)";
// $q = $pdo->prepare($sql);
// $q->execute(':datas' => $row);
// header("location: ../college.php");
// }

// if (isset($_POST["collegecode"]) || isset($_POST["collegename"]) && is_array($_POST["collegecode"]) || is_array($_POST["collegename"])){ 
// 	$input_array_name = array_filter($_POST["collegecode"]) && ($_POST["collegename"]); 
//     foreach($input_array_name as $field_value ){
//         $sql = "INSERT INTO college (\"collegeCode\", \"collegeName\") VALUES(:array)";
//         $q = $pdo->prepare($sql);
//         $query->bindparam(':array', $field_value);
//         $q->execute();
//     }
// }
$collegeCode="";
$collegename="";
if (isset($_POST["collegecode"]) ||  isset($_POST["collegename"]) && is_array($_POST["collegecode"]) || is_array($_POST["collegename"])){ 
    $input_array_code = array_filter($_POST["collegecode"]); 
    $input_array_name = array_filter($_POST["collegename"]);

    foreach ($input_array_code) and ($input_array_name){

        $sql = "INSERT INTO college (\"collegeCode\", \"collegeName\") VALUES(:collegecode,:collegename)";
		$q = $pdo->prepare($sql);
		$q->bindparam(':collegecode' => $input_array_code, ':collegename' => $input_array_name);
		//$q->bindparam(':collegename', $input_array_code);
		 
		$q->execute();


    }
   /*
        foreach(  $input_array_name as $field_name)
        {
            $collegename = $field_name;
       
        }
        */
    
}

//$sql = "INSERT INTO college (\"collegeCode\", \"collegeName\") VALUES(:collegecode,:collegename)";
 //$q = $pdo->prepare($sql);
 //$q->bindparam(':collegecode', $collegecode);
 //$q->bindparam(':collegename', $collegename);
 
 //$q->execute();
 header("location: ../college.php");





?>