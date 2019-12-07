<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once("includeThis/adFunction.php");


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
    <title>Department</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/bootstrap.js" rel="stylesheet">
  </head>
  <body>

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb col-md-12"  style="background-color: white;">
          <div class="col-md-12" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <span class="breadcrumb-item active">Department</span>
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
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="reservation.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
              <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
              <a href="department.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
            </div>
          </div>



          <div class="col-md-9">
<!--             <?php
            
            $full = $_SERVER['QUERY_STRING'];
            college_alert($full);

            ?> -->
            <!--Manage Courses-->
            <!--remove ang department from selections, but put department on the table-->

              <!--Department-->
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #cc6666; border-color: #cc6666">
                  <h3 class="panel-title" style="color: white;">Department</h3>
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
                    <div class="col-md-8 mn" align="right">
                      <button class="btn text-white" type="button" href="college_addDepartment.php" data-toggle="modal" data-target="#addDepartment" title="Add Department" style="background-color: #cc6666; border-color: #ffffff">Add New Department</button>
                    </div>
                  </div>
                  <br />
                    <!--title here-->
                    <table class="table table-data table-hover" id="myTable">
                    <thead>
                      <tr>
                        
                        <th>College Code</th>
                        <th>Department Code</th>
                        <th>Department Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <?php
                    $result = department();
                    foreach($result as $rowdept) {
                        echo "<tr>";
                        echo "<td>".$rowdept['collegeCode']."</td>";
                        echo "<td>".$rowdept['deptCode']."</td>";
                        echo "<td>".$rowdept['deptName']."</td>";
                        echo "<td><button href='college_editDepartment.php?code=".urlencode(http_build_query($rowdept))."' class='btn btn-primary' type='button' data-toggle='modal' data-target='#editDepartment' title='Edit Department'>Edit</button> <a class='btn btn-danger' href='includeThis/dept_delete.php?id=".urlencode($rowdept['deptCode'])."'>Delete</a></td>";
                        echo "</tr>";
                      }
                      ?>
                  </table>
                  </div>
                </div>
                    
  

                  </div>
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
    <div class="modal" id="addCollege" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
           <!-- college_addCollege.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="editCollege" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- college_editCollege.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="addDepartment" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
           <!-- college_addDepartment.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="editDepartment" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- college_editDepartment.php -->
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
    <script type="text/javascript">
      $(window).load(function(){
                $('#onload').modal('show');
            });
    </script>
  </body>
</html>
