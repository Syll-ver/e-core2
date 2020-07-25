<?php

require_once 'db.php';
$db = new Database();

//GET AY
if(isset($_POST['setid'])){
    $id = $_POST['setid'];
    $result = $db->settings($id);
    //echo implode($result);
    //echo $result;
    echo json_encode($result);
}

if(isset($_POST['action']) && $_POST['action'] == "savesettings"){
    $one = $_POST['one'];
    $two = $_POST['two'];
    $id = $_POST['set_id'];

    $db->saveSettings($one,$two,$id);
    echo json_encode($db);
}

if (isset($_FILES['file']['name'])) {
    $cut = $_GET['cut'];
    
    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    $i = 0;

    while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
        $id = $filesop[0];
        $lname = $filesop[1];
        $fname = $filesop[2];
        $mname = $filesop[3];
        $tcnum = $filesop[4];
        $school = $filesop[5];
        $schooladd = $filesop[6];
        $score = $filesop[7];
        $ap = $filesop[8];
        $lu = $filesop[9];
        $ma = $filesop[10];
        $sc = $filesop[11];
        $gender = $filesop[12];
        $religion = $filesop[13];
        $tribe = $filesop[14];
        $bdate = $filesop[15];
        $cell = $filesop[16];
        $strand = $filesop[17];
        $email = $filesop[18];
        $scholarship = $filesop[19];

        if($score >= $cut){
            $result = $db->importFile($id,$lname,$fname,$mname,$tcnum,$school,$schooladd,$score,$ap,$lu,$ma,$sc,$gender,$religion,$tribe,$bdate,$cell,$strand,$email,$scholarship);
        }
        $i++;
    }

    echo $result;
}



//READ ACADYEAR
if(isset($_POST['action']) && $_POST['action'] == "vieway"){
    $output = '';
    $data = $db->readAY();
    if($db->acadyearRowCount()>0){
        $output .= '<table class="table table-striped table-hover" id="viewaytable">
            <thead>
                <tr>
                    <th>Academic Year</th>
                    <th>Reservation Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
        <tbody>';
        foreach ($data as $row){
            $output .= '<tr>';
            if($row['status'] == 1){
                $output .=
                    '<td>'.$row['acadYear'].'</td>
                    <td>'.date('F j, Y', strtotime($row['reservationStart'])).' to '.date('F j, Y', strtotime($row['reservationEnd'])).'</td>
                    <td>Active</td>
                    <td>
                    <button type="button" class="btn btn-primary editBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#editAY"><i class="fas fa-edit"></i></button>
                </td></tr>';
            } else if($row['status'] == 0){
                $output .=
                    '<td>'.$row['acadYear'].'</td>
                    <td>'.date('F j, Y', strtotime($row['reservationStart'])).' to '.date('F j, Y', strtotime($row['reservationEnd'])).'</td>
                    <td>Inactive</td>
                    <td>
                    <button type="button" class="btn btn-primary editBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#editAY"><i class="fas fa-edit"></i></button>
                    <a class="btn btn-danger delBtn" title="delete" id="'.implode("=",$row).'"><i class="fas fa-trash-alt"></i></a>
                </td></tr>';
            }
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5>No record in Department."';
    }
}

//READ LATEST RESERVATIONS
if(isset($_POST['action']) && $_POST['action'] == "viewres"){
    $output = '';
    $data = $db->readLateRes();
    if($db->lateresRowCount()>0){
        $output .= '<table class="table-striped table-hover table" id="viewres">
            <thead>
                <tr>
                <th>Student Name</th>
                <th>Course</th>
                <th>Status</th>
                </tr>
                </thead>
            <tbody>';
        foreach ($data as $row){
            $output .= '<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['courseCode'].'</td>
            <td>'.$row['status'].'</td>';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5>No record in Reservation."';
    }
}

//ADD AY
if(isset($_POST['action']) && $_POST['action'] == "insertay"){
    $ay = $_POST['ay'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $status = $_POST['status'];

    $db->insertAY($ay,$start,$end,$status);
    echo json_encode($db);
}

//GET AY
if(isset($_POST['action']) && $_POST['action'] == "getay"){
    $result = $db->getAy();
    //echo json_encode($result);
    echo implode($result);
}

//EDIT AY
if(isset($_POST['action']) && $_POST['action'] == "updateay"){
    $ay = $_POST['eay'];
    $start = $_POST['estart'];
    $end = $_POST['eend'];
    $status = $_POST['estatus'];

    $db->updateAY($ay,$start,$end,$status);
}

//DELETE AY
if(isset($_POST['iday'])){
    $id = $_POST['iday'];
    $db->delAY($id);
    echo json_encode($db);
}


//READ RESERVATION
if(isset($_POST['action']) && $_POST['action'] == "viewreservation"){
	$output = '';
	$data = $db->readReservation();
	//print_r($data);
	if($db->reservationRowCount()>0){
		$output .= '<table class="table table-striped table-hover" id="mytable">
              <thead>
                <tr>
                  <th style="display: none">Year</th>
                  <th>Student Name</th>
                  <th>Strand</th>
                  <th>Course</th>
                  <th>College</th>
                  <th>Status</th>
                  <th>Date of Reservation</th>
                </tr>
                </thead>
                <tbody>';
    	foreach ($data as $row){
    		$output .= '<tr>
    		<td style="display: none">'.$row['acadYear'].'</td>
    		<td>'.$row['name'].'</td>
    		<td>'.$row['strand'].'</td>
    		<td>'.$row['courseCode'].'</td>
    		<td>'.$row['collegeCode'].'</td>
    		<td>'.$row['status'].'</td>
    		<td>'.date('F j, Y, g:i a', strtotime($row['dateReserved'])).'</td></tr>';
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record in Reservation."';
	}
}


//READ COURSE OFFERING
if(isset($_POST['action']) && $_POST['action'] == "viewcourseoffer"){
	$output = '';
	$data = $db->readCourseOffer();
	//print_r($data);
	if($db->offeringRowCount()>0){
		$output .= '<table class="table table-data table-striped table-hover" id=myTable>
                  <thead>
                    <tr>
                        <th style="display: none">Year</th>
                        <th>Course Name</th>
                        <th>Department</th>
                        <th>Strand</th>
                        <th>SASE</th>
                        <th>AP</th>
                        <th>LU</th>
                        <th>MA</th>
                        <th>SC</th>
                        <th>Slots</th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>';
    	foreach ($data as $row){
    		$output .= '<tr>
    		<td style="display: none">'.$row['acadYear'].'</td>
    		<td>'.$row['courseName'].'</td>
    		<td>'.$row['deptCode'].'</td>
    		<td>'.$row['strand'].'</td>
    		<td>'.$row['GR_criteria'].'</td>
    		<td>'.$row['AP'].'</td>
    		<td>'.$row['LU'].'</td>
    		<td>'.$row['MA'].'</td>
    		<td>'.$row['SC'].'</td>
    		<td>'.$row['slot'].'</td>
    		<td align="right">
    			<button type="button" class="btn btn-primary editBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#setcutoffModal"><i class="fas fa-edit"></i></button>

    			<a class="btn btn-danger delBtn" title="delete" id="'.implode("=",$row).'"><i class="fas fa-trash-alt"></i></a>
    		</td></tr>';
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record in Reservation Table."';
	}
}

//VIEW WHICH COURSE MAY BE OFFERED
if(isset($_POST['action']) && $_POST['action'] == "courses"){
	$output = '';
	$data = $db->courseToOffer();
	//print_r($data);
	if($db->toOfferRowCount()>0){
		$output .= '<table class="table table-hover">
              <thead>
                <tr>
                  <th><input type="checkbox" onClick="toggle(this)"></th>
                  <th>Department Name</th>
                </tr>
              </thead>
              <tbody>';
    	foreach ($data as $row){
    		$output .= '<tr>
    		<td><input type="checkbox" name="check_list[]" value="'.$row['courseCode'].'"></td>
    		<td>'.$row['courseName'].'</td></tr>';
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record."';
	}
}

//OFFER COURSE
if(isset($_POST['check_list']) && $_POST['action'] == "offercourse"){
	$checklist = $_POST['check_list'];

	$db->offerCourse($checklist);
	echo json_encode($db);
}

//EDIT OFFERED COURSE
if(!empty($_POST['action']) && $_POST['action'] == "setcutoff"){
	$code = $_POST['code'];
	$coursename = $_POST['coursename'];
	$cutOff = $_POST['cutOff']; 
	$cutOff_AP = $_POST['cutOff_AP'];
	$cutOff_LU = $_POST['cutOff_LU'];
	$cutOff_MA = $_POST['cutOff_MA']; 
	$cutOff_SC = $_POST['cutOff_SC'];
	$slot = $_POST['slot'];

	$db->setCutOff($code,$coursename,$cutOff,$cutOff_AP,$cutOff_LU,$cutOff_MA,$cutOff_SC,$slot);
	echo json_encode($db);

}

//REMOVE FROM OFFERING
if(!empty($_POST['idco'])){
	$id = $_POST['idco'];
	$db->removeFromOffering($id);
	echo json_encode($db);
}

//READ COURSES
if(isset($_POST['action']) && $_POST['action'] == "viewcourse"){
	$output = '';
	$data = $db->readCourse();
	if($db->deptRowCount()>0){
		$output .= '<table class="table table-data table-striped table-hover" id="mytable">
              <thead>
                  <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Strand</th>
                    <th>Department</th>
                    <th>College</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>';
    	foreach ($data as $row){
    		$output .= '<tr>
    		<td>'.$row['courseCode'].'</td>
    		<td>'.$row['courseName'].'</td>
    		<td>'.$row['strand'].'</td>
    		<td>'.$row['deptCode'].'</td>
    		<td>'.$row['collegeCode'].'</td>
    		<td align="right">
    			<button type="button" class="btn btn-primary editBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#editCourse"><i class="fas fa-edit"></i></button>

    			<a class="btn btn-danger delBtn" title="delete" id="'.implode("=",$row).'"><i class="fas fa-trash-alt"></i></a>
    		</td>';
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record in Course."';
	}
}

//ADD COURSE
if(isset($_POST['action']) && $_POST['action'] == "addcourse"){
	$code = $_POST['code'];
	$name = $_POST['name'];
	$dept = $_POST['dept'];
	$strand = $_POST['strand'];

	$db->insertCourse($code,$name,$dept,$strand);
	echo json_encode($db);
}

//EDIT COURSE
if(!empty($_POST['action']) && $_POST['action'] == "editcourse"){
	$code = $_POST['ecode'];
	$name = $_POST['ename'];
	$dept = $_POST['edept']; 
	$strand = $_POST['estrand'];
	$ocode = $_POST['ocode'];

	$db->editCourse($code,$name,$dept,$strand,$ocode);
	echo json_encode($db);
}

//DELETE COURSE
if(!empty($_POST['idc'])){
	$id = $_POST['idc'];
	$db->deleteCourse($id);
	echo json_encode($db);
}

//READ DEPT
if(isset($_POST['action']) && $_POST['action'] == "view"){
	$output = '';
	$data = $db->readDept();
	//print_r($data);
	if($db->deptRowCount()>0){
		$output .= '<table class="table table-striped table-hover" id="mytable">
    					<thead>
    						<tr class="text-center">
    							<th>College Code</th>
    							<th>Department Code</th>
    							<th>Department Name</th>
    							<th></th>
    						</tr>
    					</thead>
    					<tbody>';
    	foreach ($data as $row){
    		$output .= '<tr>
    		<td>'.$row['collegeCode'].'</td>
    		<td>'.$row['deptCode'].'</td>
    		<td>'.$row['deptName'].'</td>
    		<td align="right">
                <button type="button" class="btn btn-primary editBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></button>

    			<a class="btn btn-danger delBtn" title="delete" id="'.implode("=",$row).'"><i class="fas fa-trash-alt"></i></a>
    		</td></tr>

    		';
            
    	}
    	$output .= '</tbody></table>';
    	echo $output;
	} else {
		echo '<h3 class="text-center text-secondary mt-5>No record in Department."';
	}
}

//ADD DEPT
if(isset($_POST['action']) && $_POST['action'] == "insert"){
	$ccode = $_POST['ccode'];
	$dcode = $_POST['dcode']; 
	$dname = $_POST['dname'];

	$db->insertDept($ccode,$dcode,$dname);
	echo json_encode($db);
	//print $db;
}

//EDIT DEPT
// if(isset($_POST['edit_id'])){
//     $id = $_POST['edit_id'];

//     $result = $db->getDept($id);
//      echo json_encode($result);
// }

//EDIT DEPT
if(isset($_POST['action']) && $_POST['action'] == "update"){
	$id = $_POST['id'];
	$ccode = $_POST['eccode'];
	$dcode = $_POST['edcode']; 
	$dname = $_POST['edname'];

	$db->updateDept($ccode,$dcode,$dname,$id);
}

//DELETE DEPT
if(isset($_POST['idd'])){
	$id = $_POST['idd'];
	$db->delDept($id);
	echo json_encode($db);
}

//READ COLLEGE
if(isset($_POST['action']) && $_POST['action'] == "viewcollege"){
    $output = '';
    $data = $db->readCollege();
    //print_r($data);
    if($db->collegeRowCount()>0){
        $output .= '<table class="table table-striped table-hover" id="mytable">
                        <thead>
                            <tr class="text-center">
                                <th>College Code</th>
                                <th>College Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row){
            $output .= '<tr>
            <td>'.$row['collegeCode'].'</td>
            <td>'.$row['collegeName'].'</td>
            <td align="right">
                <button type="button" class="btn btn-primary editBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#editCollege" ><i class="fas fa-edit"></i></button>

                <a class="btn btn-danger delBtn" title="delete" id="'.implode("=",$row).'"><i class="fas fa-trash-alt"></i></a>
            </td></tr>

            ';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5>No record in College."';
    }
}

//ADD COLLEGE
if(isset($_POST['action']) && $_POST['action'] == "insertcollege"){
    $code = $_POST['code'];
    $name = $_POST['name'];

    $db->insertCollege($code,$name);
    echo json_encode($db);
    //print $db;
}

//EDIT COLLEGE
if(isset($_POST['action']) && $_POST['action'] == "updatecollege"){
    $ocode = $_POST['ocode'];
    $code = $_POST['ecode'];
    $name = $_POST['ename'];

    $db->updateCollege($code,$name,$ocode);
}

//DELETE COLLEGE
if(isset($_POST['idcc'])){
    $id = $_POST['idcc'];
    $db->delCollege($id);
    echo json_encode($db);
}

//READ ACCOUNTS
if(isset($_POST['action']) && $_POST['action'] == "viewaccount"){
    $output = '';
    $data = $db->readAccount();
    if($db->accountRowCount()>0){
        $output .= '<table class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Names</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($data as $row){
            if($row['role'] == "chairperson"){
                $datum = $db->getChair($row['username']);
                foreach($datum as $row2){
                    $row = array_merge($row,$row2);
                }
                
            } else if($row['role'] == "admin"){
                $datum = $db->getAdm($row['username']);
                foreach($datum as $row2){
                    $row = array_merge($row,$row2);
                }
            }
            $output .= '<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['username'].'</td>
            <td>'.$row['role'].'</td>
            <td align="right">
                <button type="button" class="btn btn-primary editBtn" id="'.implode("=",$row).'" data-toggle="modal" data-target="#editAccount"><i class="fas fa-edit"></i></button>

                <a class="btn btn-danger delBtn" title="delete" id="'.implode("=",$row).'"><i class="fas fa-trash-alt"></i></a>
            </td></tr>

            ';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5>No record in Accounts."';
    }
}

//ADD ACCOUNT
if(isset($_POST['action']) && $_POST['action'] == "insertaccount"){
    $name = $_POST['adminName'];
    $user = $_POST['adminUser'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $dept = $_POST['dept'];

    $db->insertAccount($name,$user,$password,$role,$dept);
    echo json_encode($db);

}

//EDIT ACCOUNT
if(isset($_POST['acc_id']) && $_POST['action'] == "updateaccount"){
    $id = $_POST['acc_id'];
    $user = $_POST['eadminUser'];
    $role = $_POST['erole'];
    $dept = $_POST['edept'];
    $name = $_POST['eadminName'];

    $db->updateAccount($id,$user,$role,$dept,$name);
}

//EDIT ACCOUNT
if(isset($_POST['edit_id'],$_POST['role'])){
    $id = $_POST['edit_id'];
    $role = $_POST['role'];
    $db->getAccount($id,$role);
    echo json_encode($db);
}


//DELETE ACCOUNT
if(isset($_POST['ida'])){
    $id = $_POST['ida'];
    $db->delAccount($id);
    echo json_encode($db);
}




?>