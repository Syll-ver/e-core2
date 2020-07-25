<?php

/**
 * 
 */
class Database{
	
	private $dsn = "pgsql:host=localhost;dbname=coursereservation";
	private $user = "postgres";
	private $pass = "postgres";
	private $conn;

	public function __construct(){
		try{
			$this->conn = new PDO($this->dsn,$this->user,$this->pass);
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	//ACADYEAR
	public function readAY(){
		$data = array();
		$sql = 'SELECT "acadYear", "reservationStart", "reservationEnd", "status" FROM academic_year;';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}


	//COUNT ACADYEAR
	public function acadyearRowCount(){
		$sql = 'SELECT "acadYear", "reservationStart", "reservationEnd", "status" FROM academic_year;';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();
		return $total;
	}

	//ADD ACADYEAR
	public function insertAY($acadyear, $start, $end, $status){
		$sql1 = 'INSERT INTO academic_year("acadYear", "reservationStart", "reservationEnd", "status")
				VALUES(:acadyear, :res_start, :res_end, :status);'; 
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->execute([':acadyear'=>$acadyear,':res_start'=>$start,':res_end'=>$end,':status'=>$status]);
		$result = $stmt1->fetch(PDO::FETCH_ASSOC);
		
		return true;
	}

	//UPDATE ACADYEAR
	public function updateAY($acadyear, $start, $end, $status){
		
		if($status == true){
			$sql = 'CALL activateay(:acad, :start, :end)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':acad'=>$acadyear,':start'=>$start,':end'=>$end]);
		} else {
			$sql = 'UPDATE academic_year SET "reservationStart" = :res_start, "reservationEnd" = :res_end WHERE "acadYear" = :ay ';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':res_start'=>$start,':res_end'=>$end,':ay'=>$acadyear]);
		}

		return true;
	}

	//DELETE ACADYEAR
	public function delAY($acadyear){
		$sql = 'DELETE FROM academic_year WHERE "acadYear" = :ay';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':ay'=>$acadyear]);
		return true;
	}

	public function readLateRes(){
		$data = array();
		$sql = 'SELECT concat("firstName", \' \', "lastName") "name", "courseCode", reservation."status"
                        FROM reservation
                        JOIN students USING("student_id")
                        JOIN academic_year USING("acadYear")
                        WHERE academic_year."status" = true
                        ORDER BY "dateReserved" DESC
                        LIMIT 5';
        $stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	public function lateResRowCount(){
		$sql = 'SELECT concat("firstName", \' \', "lastName") "name", "courseCode", reservation."status"
                        FROM reservation
                        JOIN students USING("student_id")
                        JOIN academic_year USING("acadYear")
                        WHERE academic_year."status" = true
                        ORDER BY "dateReserved" DESC
                        LIMIT 5';
        $stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();
		return $total;
	}

	public function getAy(){
		$sql = 'SELECT max(left("acadYear", 4)) FROM academic_year 
					GROUP BY "acadYear"
					ORDER BY "acadYear" DESC
					LIMIT 1';
        $stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function settings($id){
		$data = array();
		$sql = 'SELECT * FROM settings WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
		$stmt->execute([':id'=>$id]);
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		// foreach ($result as $row){
		// 	$data[] = $row;
		// }
		// return $data;
		return $result;
	}

	public function saveSettings($one,$two,$id){
		$sql = 'UPDATE settings SET cpscores = :one, bridging = :two where id = :id';
        $stmt = $this->conn->prepare($sql);
		$stmt->execute([':one'=>$one,':two'=>$two,':id'=>$id]);
		return true;
	}


	//RESERVATION
	public function readReservation(){
		$data = array();
		$sql = 'SELECT "acadYear", concat("firstName", \' \', "lastName") "name", students."strand", "courseCode", "collegeCode", reservation."status", "dateReserved"
                          FROM reservation
                          JOIN students USING("student_id")
                          JOIN course USING("courseCode")
                          JOIN department USING("deptCode")
                          JOIN college USING("collegeCode")
						  JOIN academic_year USING("acadYear")
						  WHERE academic_year."status" = true
                          ORDER BY "dateReserved" DESC';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	//RES ROW COUNT
	public function reservationRowCount(){
		$sql = 'SELECT "acadYear", concat("firstName", \' \', "lastName") "name", students."strand", "courseCode", "collegeCode", reservation."status", "dateReserved"
                          FROM reservation
                          JOIN students USING("student_id")
                          JOIN course USING("courseCode")
                          JOIN department USING("deptCode")
                          JOIN college USING("collegeCode")
						  JOIN academic_year USING("acadYear")
						  WHERE academic_year."status" = true
                          ORDER BY "dateReserved" DESC';
        $stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();
		return $total;
	}

	//COUNT OFFERING
	public function offeringRowCount(){
		$sql = 'SELECT * FROM course_offered
					JOIN academic_year USING("acadYear")
					WHERE status = true';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();
		return $total;
	}

	//READ OFFERING
	public function readCourseOffer(){
		$data = array();
		$sql = 'SELECT "acadYear", "courseCode", "courseName", "deptCode", "collegeCode", "strand", "GR_criteria", "AP", "LU", "MA", "SC", "slot"
							FROM course_offered
							JOIN course USING ("courseCode")
							JOIN department USING ("deptCode")
							JOIN college USING ("collegeCode")
							JOIN academic_year USING("acadYear")
							WHERE status = true';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	//COUNT TO-OFFERING
	public function toOfferRowCount(){
		$sql = 'SELECT * FROM course WHERE "courseCode" NOT IN (SELECT "courseCode" FROM course_offered
                    JOIN academic_year using ("acadYear")
                    WHERE status = true)';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();
		return $total;
	}

	public function courseToOffer(){
		$data = array();
		$sql = 'SELECT * FROM course WHERE "courseCode" NOT IN (SELECT "courseCode" FROM course_offered
                    JOIN academic_year using ("acadYear")
                    WHERE status = true)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	public function offerCourse($checklist){
		$sql1 = 'SELECT "acadYear" FROM academic_year WHERE status = true';
		$stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute();
        $ay = $stmt1->fetch();

        if(!empty($checklist)){
        	$checked_count = count($checklist);
			foreach($checklist as $selected){
				$sql = 'INSERT INTO course_offered ("acadYear", "courseCode") VALUES (:ay,:code)';
				$stmt = $this->conn->prepare($sql);
				$stmt->execute([':ay'=>$ay['acadYear'],':code'=>$selected]);
			}
			return true;
		} else {
			return false;
		}
		
	}

	public function setCutOff($code, $coursename, $cutoff, $ap, $lu, $ma, $sc, $slot){
		$sql1 = 'SELECT "acadYear", "deptCode"
						FROM course_offered
						JOIN course USING ("courseCode")
						JOIN department USING ("deptCode")
						JOIN academic_year USING ("acadYear")
						WHERE status = true AND "courseCode" = :code';
		$stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute([':code'=>$code]);
        $row = $stmt1->fetch(PDO::FETCH_ASSOC);
        $username = 'admin';

        if($stmt1->rowCount() > 0){
			$sql = 'SELECT "adminSetCutOff"(:ay, :coursecode, :gr, :ap, :lu, :ma, :sc, :slot, :username, :dept); ';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ay'=>$row['acadYear'],':coursecode'=>$code, ':gr'=>$cutoff,':ap'=>$ap,':lu'=>$lu, ':ma'=>$ma, ':sc'=>$sc, ':slot'=>$slot, ':username'=>$username, ':dept'=>$row['deptCode']]);
			
			return true;
		} else {
			return false;
		}
		
	}

	public function removeFromOffering($code){
		$sql1 = 'SELECT * FROM course_offered JOIN "academic_year" using ("acadYear") WHERE status = true AND "courseCode" = :code';
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->execute(['code'=>$code]);
		$result = $stmt1->fetch(PDO::FETCH_ASSOC);

		if($stmt1->rowCount() > 0){
			$sql = 'DELETE FROM course_offered WHERE "acadYear" = :ay AND "courseCode" = :code';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':ay'=>$result['acadYear'], 'code'=>$code]);
			return true;
		} else {
			return false;
		}
	}

	public function readCourse(){
		$data = array();
		$sql = 'SELECT "courseCode", "courseName", "strand", "deptCode", "collegeCode" 
                          FROM course
                          JOIN department USING("deptCode")
                          JOIN college USING("collegeCode")';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	public function insertCourse($code, $name, $dept, $strand){
		$sql1 = 'SELECT * FROM course WHERE "courseCode" = :code'; 
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->execute(['code'=>$code]);
		$result = $stmt1->fetch(PDO::FETCH_ASSOC);
		//return $result;
		if($stmt1->rowCount() <= 0){	//to check for duplicate
			$sql = 'INSERT INTO course("courseCode", "courseName", "deptCode", "strand") VALUES (:code,:name,:dept,:strand)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute([':code'=>$code,':name'=>$name,':dept'=>$dept,':strand'=>$strand]);

			print_r(true);
			//return json_encode(true);
		} else {
			//return json_encode(false);
			print_r(false);
		}

	}

	public function editCourse($code, $name, $dept, $strand, $ocode){
		$sql = 'UPDATE course 
			        SET "courseCode"=?, "courseName"=?, "deptCode"=?, strand=?
					WHERE "courseCode"=?';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([$code,$name,$dept,$strand,$ocode]);

		return true;
	}

	public function deleteCourse($code){
		$sql = 'DELETE FROM course WHERE "courseCode" = :code';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['code'=>$code]);
		return true;
	}

	//INSERT DEPT
	public function insertDept($ccode, $dcode, $dname){
		$sql1 = 'SELECT * FROM department WHERE "deptCode" = :code';
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->execute(['code'=>$dcode]);

		if($stmt1->rowCount() <= 0){
			$sql = 'INSERT INTO department("collegeCode", "deptCode", "deptName") VALUES (:ccode,:dcode,:dname)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['ccode'=>$ccode,'dcode'=>$dcode,'dname'=>$dname]);

			print_r(true);
		} else {
			print_r(false);
		}
		
	}

	public function getDept($code){
		$sql = 'SELECT * FROM department WHERE "deptCode" = :code';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':code'=>$code]);
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		
		return $result;
	}

	//READ DEPT
	public function readDept(){
		$data = array();
		$sql = "SELECT * FROM department";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	//EDIT DEPT
	public function updateDept($ccode, $dcode, $dname, $odcode){
		$sql = 'UPDATE department set "collegeCode" = :ccode, "deptCode" = :dcode, "deptName" = :dname WHERE "deptCode" = :odcode';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['ccode'=>$ccode, 'dcode'=>$dcode, 'dname'=>$dname, 'odcode'=>$odcode]);
		return true;
	}

	//DELETE DEPT
	public function delDept($code){
		$sql1 = 'SELECT * FROM department WHERE "deptCode" = :code';
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->execute(['code'=>$code]);
		$result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

		if($stmt1->rowCount() > 0){
			$sql = 'DELETE FROM department WHERE "deptCode" = :code';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['code'=>$code]);
			return true;
			//echo json_encode($result);
		} else {
			return false;
		}
	}

	public function deptRowCount(){
		$sql = 'SELECT * FROM department';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();

		return $total;
	}

	//INSERT COLLEGE
	public function insertCollege($code, $name){
		$sql1 = 'SELECT * FROM college WHERE "collegeCode" = :code';
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->execute(['code'=>$code]);

		if($stmt1->rowCount() <= 0){
			$sql = 'INSERT INTO college("collegeCode", "collegeName") VALUES (:code,:name)';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['code'=>$code,'name'=>$name]);

			return true;
		} else {
			return false;
		}
		
	}

	//READ COLLEGE
	public function readCollege(){
		$data = array();
		$sql = "SELECT * FROM college";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	//EDIT COLLEGE
	public function updateCollege($code, $name, $ocode){
		$sql = 'UPDATE college set "collegeCode" = :code, "collegeName" = :name WHERE "collegeCode" = :ocode';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['code'=>$code, 'name'=>$name, 'ocode'=>$ocode]);
		return true;
	}

	//DELETE COLLEGE
	public function delCollege($code){
		$sql1 = 'SELECT * FROM college WHERE "collegeCode" = :code';
		$stmt1 = $this->conn->prepare($sql1);
		$stmt1->execute(['code'=>$code]);
		$result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

		if($stmt1->rowCount() > 0){
			$sql = 'DELETE FROM college WHERE "collegeCode" = :code';
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['code'=>$code]);
			return true;
			//echo json_encode($result);
		} else {
			return false;
		}
	}

	//COUNT COLLEGE ROW
	public function collegeRowCount(){
		$sql = 'SELECT * FROM college';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();

		return $total;
	}

	//READ ACCOUNT
	public function readAccount(){
		$data = array();
		$sql = 'SELECT id, username, role FROM accounts';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	//INSERT ACCOUNT
	public function insertAccount($name, $username, $password, $role, $dept){
		$sql = 'SELECT * FROM accounts WHERE "username" = :username';		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':username'=>$username]);

			if($stmt->rowCount() <= 0){		//check to make sure no username dupe. if true (result=0), proceed
				if($role == 'admin'){
					$sql = 'CALL "newAdminAcc"(:username, :password, :role, :name);';
					$stmt = $this->conn->prepare($sql);
					$stmt->execute([':username'=>$username,':password'=>$password,':role'=>$role,':name'=>$name]);
				} else if($role == 'chairperson'){
					$sql = 'CALL "newChairAcc"(:username, :password, :role, :dept, :name);';
					$stmt = $this->conn->prepare($sql);
					$stmt->execute([':username'=>$username,':password'=>$password,':role'=>$role, ':dept'=>$dept, ':name'=>$name]);
				}
				return true;
			} else {
				return false;	//username dupe exists
			}
	}

	//EDIT ACCOUNT
	public function updateAccount($id, $username, $role, $dept, $name){
		
		$sql = 'SELECT * FROM accounts WHERE "id" = :id';		
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':id'=>$id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if($role == 'admin'){
			$sql1 = 'CALL editaccounttoadm(:id, :username, :name);';
			$stmt1 = $this->conn->prepare($sql1);
			$stmt1->execute([':id'=>$id,':username'=>$username,':name'=>$name]);
		} else if($role == 'chairperson'){
			$sql1 = 'CALL editaccounttochair(:id, :usernamu, :dept, :name);';
			$stmt1 = $this->conn->prepare($sql1);
			$stmt1->execute([':id'=>$id, ':usernamu'=>$username, ':dept'=>$dept, ':name'=>$name]);
		}

		return true;

	}

	//DELETE ACCOUNT
	public function delAccount($id){
		$sql = 'SELECT * FROM accounts WHERE id=:id';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result['role'] == 'admin'){
			$sql1 = 'CALL deladm(:id)';
			$stmt1 = $this->conn->prepare($sql1);
			$stmt1->execute(['id'=>$id]);
		} else if($result['role'] == 'chairperson'){
			$sql1 = 'CALL delchair(:id)';
			$stmt1 = $this->conn->prepare($sql1);
			$stmt1->execute(['id'=>$id]);
		}
		return true;
	}

	//GET CHAIR ACCOUNT
	public function getChair($username){
		$data = array();
		$sql = 'SELECT "name", "deptCode", "deptName" FROM accounts JOIN chairperson USING("username") JOIN department USING("deptCode") WHERE username = :username';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':username'=>$username]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	//GET ADMIN ACCOUNT
	public function getAdm($username){
		$data = array();
		$sql = 'SELECT "name" FROM accounts JOIN admin USING("username") WHERE username = :username';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([':username'=>$username]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result as $row){
			$data[] = $row;
		}
		return $data;
	}

	//COUNT ACCOUNT ROW
	public function accountRowCount(){
		$sql = 'SELECT * FROM accounts';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$total = $stmt->rowCount();

		return $total;
	}

	public function importFile($id,$fn,$ln,$mn,$tc,$school,$schoolAd,$cut,$ap,$lu,$ma,$sc,$gender,$religion,$tribe,$bdate,$cell,$strand,$email,$scholarship){
		$sql = 'INSERT INTO students("student_id", "firstName", "lastName", "middleName", "tcNum", "schoolName", "schoolAddress", "GR_criteria", "AP", "LU", "MA", "SC", "gender", "religion", "tribe", "bdate", "cellNumber", "strand", "email", "scholarship") VALUES (:id,:fn,:ln,:mn,:tc,:school,:schoolAd,:cut,:ap,:lu,:ma,:sc,:gender,:religion,:tribe,:bdate,:cell,:strand,:email,:scholarship)';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id,'fn'=>$fn,'ln'=>$ln,'mn'=>$mn,'tc'=>$tc,'school'=>$school,'schoolAd'=>$schoolAd,'cut'=>$cut,'ap'=>$ap,'lu'=>$lu,'ma'=>$ma,'sc'=>$sc,'gender'=>$gender,'religion'=>$religion,'tribe'=>$tribe,'bdate'=>$bdate,'cell'=>$cell,'strand'=>$strand,'email'=>$email,'scholarship'=>$scholarship]);

		return true;
	}

}

// $ob = new Database();
// $a = $ob->getDept('Econ');
// echo json_encode($a);