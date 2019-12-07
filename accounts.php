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
    <title>Accounts</title>
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

    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb"  style="background-color: white;">
          <div class="col-md-11" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <span class="breadcrumb-item active">Accounts</span>
          </div>
        </nav>
      </div>
    </section>

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
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
            </div>
            
          </div>



          <div class="col-md-9">
            <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if(strpos($fullUrl, "acct=dup1") == true){
              echo "<div class=\"alert alert-warning\" role=\"alert\">
                      Duplicate is detected.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
            } else if (strpos($fullUrl, "acct=adm") == true){
              echo "<div class=\"alert alert-success\" role=\"alert\">
                      You have successfully added a new admin account!
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
            } else if (strpos($fullUrl, "acct=chr") == true){
              echo "<div class=\"alert alert-success\" role=\"alert\">
                      You have successfully added a new chairperson account!
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
            } else if(strpos($fullUrl, "del=true") == true){
              echo "<div class=\"alert alert-danger\" role=\"alert\">
                      You have deleted an account.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>";
            }
            ?>
            <!--Academic Year Setting-->
            <div class="panel panel-default">
              <div class="panel-heading col-md-12" style="margin-bottom: 1%; background-color: #cc6666;">
                <h3 class="panel-title" style="color: white;">Manage Accounts</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control search-filter" data-table="table-data" name="college" id="college">
                      <option value="">All Accounts</option>
                      <option value="admin">Admin</option>
                      <option value="chairperson">Chairperson</option>
                    </select>
                  </div>
                      <div class="col-md-4" align="right">
                          <div align="right">
                            <input class="form-control search-filter" type="search" data-table="table-data" placeholder="Filter search...">
                          </div>
                          <!-- make it so pwede masearch pati ang starting year sa academic year -->
                      </div>
                      <div class="col-md-4" align="right">
                        <button class="btn btn-primary" href="admin_addAdmin.php" data-toggle="modal" data-target="#addAdmin" style="background-color: #cc6666; border-color: #cc6666;">New Account</button>
                      </div>
                </div>
                <br>
                <table class="table table-data table-hover" id=myTable>
                  <thead>
                    <tr>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $result = admin();
                    foreach($result as $row) {
                    echo "<tr>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['role']."</td>";
                    echo "<td><button href='admin_editAdmin.php?id=".urlencode(http_build_query($row))."' class='btn btn-primary' type='button' data-toggle='modal' data-target='#editAdmin' title='Edit Department'>Edit</button> <a class='btn btn-danger' href='includeThis/admin_delete.php?id=".$row['id']."'>Delete</a></td>";
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
    <div class="modal" id="addAdmin" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- admin_addAdmin.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="delAdmin" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- admin_delAdmin.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="editAdmin" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- admin_editAdmin.php -->
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
</html>
