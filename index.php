<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include("includeThis/adFunction.php");

/*
when using single quotation, escaping the string is an option: "\" like $string = 'It\'s ok here too';
*/
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/bootstrap.js" rel="stylesheet">
  </head>
  <body>

    <!-- navbar -->
    <?php include "includes/navbar.php";?>
    <!-- #end navbar -->
    
    <!-- breadcrumb -->
    <section id="breadcrumb">
      <div class="container">
      	<nav class="breadcrumb"  style="background-color: white;">
          <div class="col-md-12" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <span class="breadcrumb-item active">Dashboard</span>
          </div>
		  <!-- Breadcrumb Menu-->
		</nav>
      </div>
    </section>
    <!-- #end breadcrumb -->

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3" style="margin-bottom: 30px;">
            <div class="list-group">
              <a href="index.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="reservation.php" class="list-group-item "><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
              <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>

            </div>
          </div>

          <div class="col-md-9">
            <div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                      <?php
                      $row = reserved();
                        echo $row['x'];
                        ?>
                    </h2>
                    <h5>Students Reserved</h5>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                      <?php
                      $row = waitlisted();
                        echo $row['count'];
                      ?>
                    </h2>
                    <h5>Students on Waitlist</h5>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                      <?php
                      $row = courses();
                        echo $row['count'];
                      ?>
                    </h2>
                    <h5>Offered Courses</h5>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 
                      <?php
                      $row = passers();
                      echo $row['count'];
                      ?>
                    </h2>
                    <h5>SASE Passers</h5>
                  </div>
                </div>
            </div>

            <!-- <div class="col-md-12"> -->
              <div class="col-md-12">
                <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Academic Year</h3>
                </div>
                <div class="panel-body">
                  <div class="col-md-12" align="right">
                    <button class="btn btn-primary text-white" href="ay_add.php" type="button" data-toggle="modal" data-target="#ayAdd" style="background-color: #cc6666; border-color: #ffffff">Add Academic Year</button>
                  </div>
                  <div class="container" >
                    <!--title here-->
                    <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Academic Year</th>
                        <th>Reservation Date</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ay = acadyearlist();
                      foreach($ay as $i){
                        if($i['status'] == 1){
                          echo "<tr>";
                          echo "<td>".$i['acadYear']."</td>";
                          echo "<td>".date('F j, Y', strtotime($i['reservationStart']))." to<br> ".date('F j, Y', strtotime($i['reservationEnd']))."</td>";
                          echo "<td>active</td>";
                          echo "<td><button href='ay_edit.php?id=".urlencode(http_build_query($i))."' class='btn btn-primary glyphicon glyphicon-edit' type='button' data-toggle='modal' data-target='#ayEdit' title='Edit Academic Year'> </button></td>";
                          echo "</tr>";
                        } else if($i['status'] == 0){
                          echo "<tr>";
                          echo "<td>".$i['acadYear']."</td>";
                          echo "<td>".date('F j, Y', strtotime($i['reservationStart']))." to<br> ".date('F j, Y', strtotime($i['reservationEnd']))."</td>";
                          echo "<td>inactive</td>";
                          echo "<td><button href='ay_edit.php?id=".urlencode(http_build_query($i))."' class='btn btn-primary glyphicon glyphicon-edit' type='button' data-toggle='modal' data-target='#ayEdit' title='Edit Academic Year'> </button><a class='btn btn-danger glyphicon glyphicon-trash' href='includeThis/ay_delete.php?id=".urlencode($i['acadYear'])."'> </a></td>";
                          echo "</tr>";
                        }

                      }
                      ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
              </div>

              <!-- <div class="col-md-5">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Schedule of Reservation</h3>
                  </div>
                  <div class="panel-body">
                    <div class="col-md-12" align="right">
                      <button class="btn text-white" href="sched_add.php" type="button" data-toggle="modal" data-target="#schedAdd" style="background-color: #cc6666; border-color: #ffffff">Add Schedule</button>
                    </div>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Scores</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sched = scoreSched();
                          foreach($sched as $row) {
                            echo "<tr>";
                            echo "<td>".date('F j, Y', strtotime($row['schedule']))."</td>";
                            echo "<td>".$row['scores']."</td>";
                            echo "<td> <button href='sched_edit.php?id=".urlencode($row['id'])."' class='btn btn-primary glyphicon glyphicon-edit' type='button' data-toggle='modal' data-target='#schedEdit' title='Edit Schedule'></button> <a class='btn btn-danger glyphicon glyphicon-trash' href='includeThis/sched_del.php?id=".urlencode($row['id'])."'></a></td>";
                            echo "</tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div> -->
            <!-- </div> -->

              <!-- Latest Users -->
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Latest Reservations</h3>
                  </div>
                  <div class="panel-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Student Name</th>
                          <th>Course</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $reserves = latestReserves();
                          foreach($reserves as $row) {
                            echo "<tr>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['courseCode']."</td>";
                            echo "<td>".$row['status']."</td>";
                            echo "</tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <!--Start Footer -->
    <?php include "includes/footer.php";?>
    <!--End Footer -->

    <!-- Modals -->
    <div class="modal" id="ayAdd" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- ay_add.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="ayEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- ay_edit.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="schedAdd" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- ay_edit.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="schedEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- ay_edit.php -->
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/tagsinput.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="script_filterSearch.js"></script>
    
  </body>
</html>
