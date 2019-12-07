<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once("includeThis/adFunction.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Course</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/bootstrap.js" rel="stylesheet">
  </head>
  <body>

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <!-- breadcrumb -->
    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb col-md-12"  style="background-color: white;">
          <div class="col-md-12" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <a class="breadcrumb-item" href="courseOffers.php">Offered Courses</a>
            <span class="breadcrumb-item active">Manage Courses</span>
          </div>
      <!-- Breadcrumb Menu-->
        </nav>
      </div>
    </section>
    <!--#end breadcrumb-->

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="reservation.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
              <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
              <a href="course.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
              <!-- <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a> -->
            </div>


          </div>

          
          <div class="col-md-9">
            <!--Manage Courses-->
            <!--remove ang department from selections, but put department on the table-->
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #cc6666;">
                <h3 class="panel-title" style="color: white;">Manage Courses</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control search-filter" data-table="table-data" name="college" id="college">
                        <?php
                        $college = selectCollege();
                        ?>
                    </select>
                  </div>
                      <div class="col-md-8" align="right">
                          <!-- <input class="form-control search-filter" type="search" data-table="table-data" placeholder="Filter search..."> -->
                          <!-- make it so pwede masearch pati ang starting year sa academic year -->
                          <button class="btn text-white" href="course_addCourse.php" data-toggle="modal" data-target="#addCourse" style="background-color: #cc6666; border-color: #ffffff">Add New Course</button>
                      </div>
                </div>
                <br>
                <table class="table table-data table-hover" id="myTable">
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
                    <tbody>
                      <?php
                      $result = course();
                      foreach($result as $row) {
                        echo "<tr>";
                        echo "<td>".$row['courseCode']."</td>";
                        echo "<td>".$row['courseName']."</td>";
                        echo "<td>".$row['strand']."</td>";
                        echo "<td>".$row['deptCode']."</td>";
                        echo "<td>".$row['collegeCode']."</td>";
                        echo "<td> <button href='course_editCourse.php?oldcode=".urlencode(http_build_query($row))."' class='btn btn-primary' type='button' data-toggle='modal' data-target='#editCourse' title='Edit Course'>Edit</button> <a class='btn btn-danger' href='includeThis/course_del.php?id=".urlencode($row['courseCode'])."'>Delete</a></td>";
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
    </section>

    <!--Footer-->
    <?php include "includes/footer.php";?>
    <!--#end Footer-->

    <!-- Modals -->
    <div class="modal" id="addCourse" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- course_addCourse.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="editCourse" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- course_editCourse.php -->
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
