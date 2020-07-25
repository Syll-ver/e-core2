<?php
include_once("config/config.php");

function latestReserves(){
	global $pdo;
	//FUNCTION SHOULD ACCEPT ACADYEAR SO A WHERE acadYear = '2019-2020' CLAUSE CAN BE ADDED

	$result = $pdo->query('SELECT concat("firstName", \' \', "lastName") "name", "courseCode", reservation."status"
                        FROM reservation
                        JOIN students USING("student_id")
                        JOIN academic_year USING("acadYear")
                        WHERE academic_year."status" = true
                        ORDER BY "dateReserved" DESC' );

	return $result->fetchAll();
}

function reserved(){
	global $pdo;
	$reserved = $pdo->query('SELECT COUNT(*) x
                          FROM reservation
                          JOIN academic_year USING("acadYear")
                          WHERE academic_year."status" = true
                          AND reservation."status"
                          LIKE \'%reserved%\'');
	return $reserved->fetch(PDO::FETCH_ASSOC);
}

function waitlisted(){
	global $pdo;
	$waitlisted = $pdo->query('SELECT COUNT("student_id")
                            FROM reservation
                            JOIN academic_year USING("acadYear")
	                        WHERE academic_year."status" = true
	                        AND reservation."status"
                            LIKE \'%waitlisted%\'');

	return $waitlisted->fetch(PDO::FETCH_ASSOC);
}

function courses(){
	global $pdo;
	$courses = $pdo->query('SELECT COUNT("courseCode")
                          	FROM course_offered
                          	JOIN academic_year USING ("acadYear")
                          	WHERE status = true');

	return $courses->fetch(PDO::FETCH_ASSOC);
}

function passers(){
	global $pdo;
	$passers = $pdo->query('SELECT COUNT("student_id")
                          FROM students
                          WHERE LEFT("student_id", 4) = (SELECT LEFT("acadYear", 4)
                      			FROM academic_year WHERE status = true)');

	return $passers->fetch(PDO::FETCH_ASSOC);
}

function reservation(){
	global $pdo;
	$result = $pdo->query('SELECT "acadYear", concat("firstName", \' \', "lastName") "name", students."strand", "courseCode", "collegeCode", reservation."status", "dateReserved"
                          FROM reservation
                          JOIN students USING("student_id")
                          JOIN course USING("courseCode")
                          JOIN department USING("deptCode")
                          JOIN college USING("collegeCode")
						  JOIN academic_year USING("acadYear")
						  WHERE academic_year."status" = true
                          ORDER BY "dateReserved" DESC');

	return $result->fetchAll();
}

function course(){
	global $pdo;
	$result = $pdo->query('SELECT "courseCode", "courseName", "strand", "deptCode", "collegeCode" 
                          FROM course
                          JOIN department USING("deptCode")
                          JOIN college USING("collegeCode")' );

	return $result->fetchAll();
}

function college(){
	global $pdo;
	$result = $pdo->query('SELECT  * from college');

	return $result->fetchAll();
}

function department(){
	global $pdo;
	$resultdept = $pdo->query('SELECT * FROM department');

	return $resultdept->fetchAll();
}

function admin(){
	global $pdo;
	$admin = $pdo->query('SELECT "id", "username", "role"
                        FROM accounts');
	return $admin->fetchAll();
}

function navbar(){
	global $pdo;
	$notifCount = $pdo->query("SELECT COUNT(\"id\") FROM \"notif\" WHERE status = '0' AND sender != '".$user."';");
	
	return $notifCount->fetch(PDO::FETCH_ASSOC);
}

function viewNotif(){
	global $pdo;
	$notifView = $pdo->query("SELECT * FROM notif ORDER BY \"date\" DESC");
	
	return $notifView->fetchAll();
}

function receiverRole(){
	global $pdo;
	$role = $pdo->query("SELECT * FROM notif");
	
	return $notifView->fetchAll();


}

function myAdminAccount($user){
	global $pdo;

	$my = $pdo->query("SELECT * FROM accounts JOIN admin USING (username) WHERE username ='".$user."';");
	return $my->fetch(PDO::FETCH_ASSOC);

}

function courseToOffer(){
	global $pdo;
	$result = $pdo->query('SELECT * FROM course_offered
							JOIN academic_year USING ("acadYear")
							WHERE status = true');
	return $result->fetchAll();
}

function courseOffers(){
	global $pdo;
	$result = $pdo->query('SELECT "acadYear", "courseCode", "courseName", "deptCode", "collegeCode", "strand", "GR_criteria", "AP", "LU", "MA", "SC", "slot"
							FROM course_offered
							JOIN course USING ("courseCode")
							JOIN department USING ("deptCode")
							JOIN college USING ("collegeCode")
							JOIN academic_year USING("acadYear")
							WHERE status = true');

	return $result->fetchAll();
}

function notifCount($user){
	global $pdo;
	$notifCount = $pdo->query("SELECT COUNT(id) FROM notif
							WHERE status = false
							AND receiver = '".$user."';");
	$row = $notifCount->fetch(PDO::FETCH_ASSOC);

	if($row['count'] != '0'){
        echo "<span class=\"badge badge-light\">".$row['count']."</span>";
    }
}

function notification($user){
	global $pdo;
	$notification = $pdo->query("SELECT DISTINCT id, status, sender, receiver, username, receiver, chairperson.\"deptCode\",
									action, type, date, \"courseCode\"
									FROM notif, chairperson, course
									WHERE sender = '".$user."'
									ORDER BY date DESC");

	/*for chairperson
	$notification = $pdo->query("SELECT DISTINCT id, status, sender, receiver, username, receiver, chairperson.\"deptCode\",
									action, type, date, \"courseCode\"
									FROM notif, chairperson, course
									WHERE receiver = '".$user."' AND chairperson.\"deptCode\" = '".$user."' and course.\"deptCode\" = '".$user."'
									ORDER BY date DESC"
	*/

	$rows = $notification->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) > 0){
          foreach($rows as $i){
            echo "<a ";
            if($i['status'] == '0') {
              echo "style='font-weight: bold;'";
            }
            echo "class='dropdown-item' href='includeThis/notification_view.php?id=".$i['id']."' data-toggle='modal' data-target='#notifMe'> <small><i>".date('F j, Y, g:i a', strtotime($i['date']))."</i></small><br />";

            if($i['type'] == 'cut-off'){
              //echo $i['sender']." set the cut-off score for course chuchu.";
            	echo $i['courseCode']." cut-off scores has been set by ".$i['username'].".";
            } else {
            echo "<div class='dropdown-divider'></div> <br /> No new notification.";
            }
        }
        echo "</a>";
      } else {
        echo "<a class='dropdown-item'> No new notification </a>";
      }
}


function acadyear(){
	global $pdo;
	$result = $pdo->query("SELECT * FROM academic_year;");
	$rows = $result->fetchAll();

	if($rows['status'] == true){
		echo "<option value='".$rows['acadYear']."' default>".$rows['acadYear']."</option>";
	} else if($rows['status'] == false){
		foreach($rows as $i){
			echo "<option value='".$i['acadYear']."'>".$i['acadYear']."</option>";
		}
	}

}

function selectCollege(){
	global $pdo;
	$result = $pdo->query("SELECT * FROM college;");
	$rows = $result->fetchAll();

	echo "<option value=''>".'Colleges'."</option>";
	foreach($rows as $i){
		echo "<option value='".$i['collegeCode']."' default>".$i['collegeName']."</option>";
	}	

}

function acadyearlist(){
	global $pdo;
	$result = $pdo->query('SELECT "acadYear", "reservationStart", "reservationEnd", "status" FROM academic_year;');
	return $result->fetchAll();	
}

function activeay(){
	global $pdo;
	$result = $pdo->query('SELECT "acadYear", "reservationStart", "reservationEnd", "status" FROM academic_year WHERE status = true;');
	return $result->fetch(PDO::FETCH_ASSOC);	
}

function scoreSched(){
	global $pdo;
	$result = $pdo->query("SELECT id, CONCAT(\"scoreStart\", '-', \"scoreEnd\") AS scores, schedule, \"acadYear\" 
							FROM score_schedule
							JOIN academic_year USING (\"acadYear\")");
	return $result->fetchAll();
}

function currentYear(){
	global $pdo;
	$result = $pdo->query("SELECT \"\" FROM score_schedule
							JOIN academic_year USING (\"acadYear\")");
	return $result->fetchAll();
}

function college_alert($full){
	$parsedfull = parse_url(urldecode($full));
    $from_arr = implode(' ', $parsedfull);
    $to_arr = explode('&', $from_arr);

    if($to_arr[0] == 'hinzugeben'){ //zur Bestätigung des Zusatzes
    	echo
    	'<div class="alert alert-success" role="alert">
    		You have successfully added '.substr($to_arr[1], 2).'
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	                        <span aria-hidden="true">&times;</span>
			</button>
		</div>';
    } else if($to_arr[0] == 'tilgen'){ //Warnung zum Löschen
    	echo 
    	'<div class="alert alert-danger" role="alert">
            You have deleted a college.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
            </button>
        </div>';

    } else if($to_arr[0] == 'doppelte'){ //um nach Duplikaten zu suchen
    	echo 
    	'<div class="alert alert-warning" role="alert">
            Duplicate is detected.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
}







?>