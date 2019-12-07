<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}

include_once("functions.php");

$user = htmlspecialchars($_SESSION["username"]);
//$chairDept = lingkuranan($user);
$department = getDept($user);
$course = get_CourseCode($user);

$resulta = $pdo->query("SELECT * FROM course_offered JOIN course ON course_offered.\"courseCode\" = course.\"courseCode\"
JOIN chairperson ON chairperson.\"deptCode\" = course.\"deptCode\" WHERE username ='".$user."';");

$result = $pdo->query("SELECT \"student_id\",concat(\"firstName\", ' ', \"lastName\") \"name\", \"GR_criteria\", \"status\", \"strand\", \"dateReserved\"
FROM reservation
JOIN students USING(\"student_id\")
WHERE \"courseCode\" = '".$course['get_coursecode']."' AND \"status\" != 'enrolled'
ORDER BY \"dateReserved\" DESC" );

//$notifCount = $pdo->query("SELECT COUNT(id) FROM notif WHERE status = '0' AND receiver = '".$chairDept['deptCode']."' ;");

$notification = $pdo->query("SELECT * FROM notif WHERE receiver ='".$department['get_dept']."' ORDER BY date DESC");

$reserved = $pdo->query('SELECT COUNT(*) x
                          FROM reservation
                          WHERE status
                          LIKE \'%reserved%\' AND "courseCode" LIKE \'%'.$course['get_coursecode'].'%\'');
$waitlisted = $pdo->query('SELECT COUNT("student_id")
                            FROM reservation
                            WHERE status
                            LIKE \'%waitlisted%\' AND "courseCode" LIKE \'%'.$course['get_coursecode'].'%\'');
$remSlots = $pdo->query('SELECT slot, (slot - COUNT(student_id)) AS "remaining"
                          FROM course_offered
                          JOIN reservation USING ("courseCode")
                          WHERE "courseCode" = \'%'.$course['get_coursecode'].'%\' AND status = \'reserved\'
                          GROUP BY slot');

$enrolled = $pdo->query('SELECT COUNT(*) AS "enrolled" FROM reservation WHERE "status" LIKE \'%enrolled%\' AND "courseCode" LIKE \'%'.$course['get_coursecode'].'%\';');
/*
when using single quotation, escaping the string is an option: "\" like $string = 'It\'s ok here too';
*/
$bow = $resulta->fetch(PDO::FETCH_ASSOC)
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chairperson | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../assets/js/bootstrap.js" rel="stylesheet">
  <style>
.button{
  background-color: #cc6666;
  font-size: 13px;
  color: white;
  padding: 5px 18px;
}
.badge-light{
   position: relative;
   top: -9px;
   left: -17px;
}
</style>
 </head>
  <body>

    <!--navbar-->
  <header class="navbar navbar-expand flex-column flex-md-row bd-navbar" style="border-radius: 0; font-size: 13px;">
  <a class="navbar-brand mr-0 mr-md-2" href="index.php" aria-label="Bootstrap" style="padding-top: 15px;"><h3>MSU-General Santos e-CORE</h3></a>

  <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
    <li class="nav-item dropdown">
      <a class="nav-item nav-link mr-md-2" href="#" id="notifdropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-bell">
          <?php
          $row = notifCount($department['get_dept']);
          //$row =  $notifCount->fetch(PDO::FETCH_ASSOC);
          if($row['count'] != '0'){
            echo "<span class=\"badge badge-light\">".$row['count']."</span>";
          }
          ?>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifdropdown">
        <?php
        $rows = $notification->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows) > 0){
          foreach($rows as $i){
            echo "<a ";
            if($i['status'] == 0) {
              echo "style='font-weight: bold;'";
            }
            echo "class='dropdown-item' href='../includeThis/notification_view.php?id=".$i['id']."' data-toggle='modal' data-target='#notifMe'> <small><i>".date('F j, Y, g:i a', strtotime($i['date']))."</i></small><br />";

            if($i['type'] == 'cut-off'){
              echo $i['sender']." set the cut-off score for course chuchu.";
            } else if($i['type'] == 'reminder'){
              echo $i['sender']." sent you a reminder with subject: ".$i['title'];
            } else {
            echo "<div class='dropdown-divider'></div> <br /> No new notification.";
            }
        }
        echo "</a>";
      }
        ?>
      

          
          

        
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
        <a class="dropdown-item active" href="myAccount.php">My Account</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
</header>
    <!-- #end navbar-->

    <section id="main">
      <div class="container">
        <div class="row">
          
          <div class="col-md-12 ">
            <!-- Reservation Overview -->
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #cc6666; border-color: #cc6666">
                <h3 class="panel-title" style="color: white;">RESERVATION OVERVIEW</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                      <?php
                        $row = $reserved->fetch(PDO::FETCH_ASSOC);
                        echo $row['x'];
                        ?>
                    </h2>
                    <h4>Reserved</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <?php
                        $row = $waitlisted->fetch(PDO::FETCH_ASSOC);
                        echo $row['count'];
                      ?>
                    </h2>
                    <h4>Waitlist</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2>
                    <?php
                        $row = $remSlots->fetch(PDO::FETCH_ASSOC);
                        echo $row['remaining']." of ".$row['slot'];
                      ?></h2>
                    <h4>Remaining Slots</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                    <?php
                        $row = $enrolled->fetch(PDO::FETCH_ASSOC);
                        echo $row['enrolled'];
                      ?></h2>
                    <h4>Enrolled Students</h4>
                  </div>
                </div>
              </div>
              </div>
              <!--#end Reservation overview-->

              
              <div class="panel panel-default" style="">
              <div class="panel-heading col-md-12" style="background-color: #cc6666; border-color: #cc6666">
                <h3 class="panel-title col-md-10" style="color: white;">CUT-OFF SCORES</h3>
                <div class="col-md-2" >
 <?php 
  
    if($bow['username'] == $user ){
     
 }  else {   
 echo "<button href=\"c_setCutOff.php?id=".urlencode($user)."\" class=\"btn btn-success\" type=\"button\" data-toggle=\"modal\" data-target=\"#setCutOff\" title=\"AddCutOffScores\">CREATE SCORE</button>";
  
 }

?>
                  </div>
</div>
              <div class="panel-body">
              <table class="table table-hover">
              <tr>
              </tr>
              <tr>
                        <th>Academic Year</th>
                        <th>Course Code</th>
                        <th>GR criteria</th>
                        <th>AP</th>
                        <th>LU</th> 
                        <th>MA</th>
                        <th>SC</th>
                        <th>Slot</th>
                         
                      </tr>
                      
                      <?php  if($bow['GR_criteria'] == !null){
                        echo "<tr>";
                        echo "<td>".$bow['acadYear']."</td>";
                        echo "<td>".$bow['courseCode']."</td>";
                        echo "<td>".$bow['GR_criteria']."</td>";
                        echo "<td>".$bow['AP']."</td>";
                        echo "<td>".$bow['LU']."</td>";
                        echo "<td>".$bow['MA']."</td>";
                        echo "<td>".$bow['SC']."</td>";
                        echo "<td>".$bow['slot']."</td>";
                        echo "<td><button href=\"c_editCutOff.php?id=".urlencode($user)."\" class='btn btn-primary' type='button' data-toggle='modal' data-target='#editScores' title='Edit Scores' '>Edit</button></td>";
                        echo "</tr>";
                      
                      }
                      ?>
                    </table>
              </div>
      
              </div>


              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading col-md-12" style="margin-bottom: 1%; background-color: #cc6666; border-color: #cc6666">
                  <div class="col-md-11">
                    <h3 class="panel-title" style="color: white;">LIST OF RESERVATION:  <?php echo $course['get_coursecode'] ?></h3>
                  </div>
                  <div class="col-md-1" style="position:">
                  <a href="c_printList.php"><button class="btn btn-success glyphicon glyphicon-print btn-sm" type="button" title="Print Reservation List"></button><a>
                  </div>
                </div>
                <div class="panel-body">
                  <table class="table table-hover">
                      <thead>
                        <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Strand</th>
                        <th>SASE</th>
                        <th>Status</th>
                        <th>Date of Reservation</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $counter = 1;
                        
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                          echo "<tr>";
                          echo "<td>".$counter."</td>";
                          echo "<td>".$row['name']."</td>";
                          echo "<td>".$row['strand']."</td>";
                          echo "<td>".$row['GR_criteria']."</td>";
                          echo "<td>".$row['status']."</td>";
                          echo "<td>".$row['dateReserved']."</td>";
                          echo "<td><a class='btn button' href='includes/enroll.php?id=".urlencode($row['student_id'])."' type='submit' name='theButton'>Enroll</a></td>";
                          echo "</tr>";
                          $counter++;
                      }
                      ?>
                      </tbody>
                    </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <!--Footer-->
    <?php include "includes/c_footer.php";?>
    <!--#end Footer-->

    <!-- Modals -->
    <div class="modal" id="setCutOff" role="dialog">
      <div class="modal-dialog modal-md" role="document"> 
        <div class="modal-content">
           <!-- c_setCutOff.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="editScores" role="dialog">
      <div class="modal-dialog modal-md" role="document"> 
        <div class="modal-content">
           <!-- c_setCutOff.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="notifMe" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
        <!-- college_editCollege.php -->
        </div>
      </div>
    </div>

    <!-- Add Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Page Title</label>
          <input type="text" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Page Body</label>
          <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add Some Tags...">
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
