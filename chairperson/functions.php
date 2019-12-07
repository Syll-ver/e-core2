<?php
include_once("../config/config.php");

function lingkuranan($user){
  global $pdo;
  $chair = $pdo->query("SELECT \"deptCode\", \"courseCode\" FROM department
        JOIN course USING (\"deptCode\")
        JOIN chairperson USING (\"deptCode\")
        where username = '".$user."';");
  return $chair->fetch(PDO::FETCH_ASSOC);
}

function getDept($user){
  global $pdo;
	$chair = $pdo->query("SELECT get_dept('".$user."');");
	return $chair->fetch(PDO::FETCH_ASSOC);
}

function getCourseCode($user){
  global $pdo;
  $code = $pdo->query("SELECT get_coursecode('".$user."');");
  return $code->fetch(PDO::FETCH_ASSOC);
}

function notifCount($receiver){
  global $pdo;
  //$deptCode = $pdo->query('CALL getChairDept($user);');
  $count = $pdo->query("SELECT COUNT(id) FROM notif WHERE status = false AND receiver = '".$receiver."' ;");
  return $count->fetch(PDO::FETCH_ASSOC);

}


















/**


$result = $pdo->query("SELECT concat(\"firstName\", ' ', \"lastName\") \"name\", \"GR_criteria\", \"status\", \"strand\", \"dateReserved\"
                        FROM reservation
                        JOIN students USING(\"student_id\")
                        WHERE \"courseCode\" = '".$chairDept['courseCode']."'
                        ORDER BY \"dateReserved\" DESC" );

$notifCount = $pdo->query("SELECT COUNT(id) FROM notif WHERE status = '0' AND receiver = '".$chairDept['deptCode']."' ;");

$notification = $pdo->query("SELECT * FROM notif WHERE receiver ='".$chairDept['deptCode']."' ORDER BY date DESC");

$reserved = $pdo->query('SELECT COUNT(*) x
                          FROM reservation
                          WHERE status
                          LIKE \'%reserved%\' AND "courseCode" LIKE \'BS IT\' ');
$waitlisted = $pdo->query('SELECT COUNT("student_id")
                            FROM reservation
                            WHERE status
                            LIKE \'%waitlisted%\' AND "courseCode" LIKE \'BS IT\'');
$remSlots = $pdo->query('SELECT slot, (slot - COUNT(student_id)) AS "remaining"
                          FROM cut_off
                          JOIN reservation USING ("courseCode")
                          WHERE "courseCode" = \'BS IT\' AND status = \'reserved\'
                          GROUP BY include_once("../config/config.php");


**/

?>