<?php

require_once 'db.php';
$db = new Database();

if(isset($_POST['action']) && $_POST['action'] == "view"){
	$output = '';
	$data = $db->readdept();
	if($db->deptRowCount()>0){
		$output .= '
                    <thead>
                      <tr>
                        <th>College Code</th>
                        <th>Department Code</th>
                        <th>Department Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>';
            foreach ($data as $row) {
            	$output .= '<tr class="text secondary">
            					<td>'.$row['collegeCode'].'</td>
            					<td>'.$row['deptCode'].'</td>
            					<td>'.$row['deptName'].'</td>
            					<td><button href="../college_editDepartment.php?code="'.urlencode(http_build_query($row)).'" class="btn btn-primary" type="button" data-toggle="modal" data-target="#editDepartment" title="Edit Department">Edit</button> <a class="btn btn-danger" href="includeThis/dept_delete.php?id="'.urlencode($row['deptCode']).'">Delete</a></td>
            				</tr>';
            }
            $output .= '</tbody>';
            echo $output;
	}
	else {
		echo '<h3 class="text-center text-secondary mt-5"> No data. </h3>';
	}

}

?>