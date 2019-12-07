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
    <title>Reservation</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/bootstrap.js" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>

  <body class="">

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <!--breadcrumb-->
    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb col-md-12"  style="background-color: white;">
          <div class="col-md-10" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <span class="breadcrumb-item active">Reservation</span>
          </div>
      <!-- Breadcrumb Menu-->
          <div class="col-md-2" style="margin-right: 0;">
            <div class="breadcrumb-menu" >
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="background-color: #cc6666;">
                <button class="btn text-white" href="reservation_reserveSlot.php" type="button" data-toggle="modal" data-target="#reserveSlot" style="border-color: #ffffff">Reserve A Slot</button>
                <button class="btn text-white" type="button" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-color: #ffffff; border-radius: .25rem"><span class="glyphicon glyphicon-cog"></span> Reservation Settings</button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                  
                  <a class="dropdown-item" href="reservationAcadYear.php">Academic Year</a>
                  <a class="dropdown-item" href="courseOffers.php">Offered Courses</a>
                </div>
              </div>
            </div>  
          </div>
        </nav>
      </div>
    </section>
    <!--#end breadcrumb-->

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="reservation.php" class="list-group-item active" style="background-color: #cc6666; border-color: #cc6666"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Course </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admin </a>
              <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a>
            </div>
          </div>

          <div class="col-md-9">
            <!-- Reservation List View -->
            <div class="panel panel-default">
              <div class="panel-heading col-md-12" style="margin-bottom: 1%; background-color: #cc6666">
                <div class="col-md-12">
                  <h4 class="panel-title col-md-6" style="margin-top: 1%; color: white;">List of Reserved Students</h4>
                  <form class="form-group form-inline" style="margin-top: 7px;">
                    <div class="col-md-3"></div>
                    <label for="acadyear" class="col-md-5"><h5>Academic Year:</h5></label>
                    <div class="col-md-2">
                      <select class="form-control" onchange="" name="acadyear" id="acadyear">
                      <option default>2019-2020</option> <!-- make it so default ang current AY. or ang default ang active -->
                      <option>2018-2019</option>
                      <option>2017-2018</option>
                      <!-- pwede ma-view and ma-print ang previous reservation -->
                    </select>
                    </div>
                  </form>
                </div>
                <div class="row col-md-3"></div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-6">
                    <?php include "includes/selection_college.php";?>
                  </div>
                      <div class="col-md-6">
                          <input class="form-control search-filter" type="search" data-table="table-data" placeholder="Filter search...">
                          <!-- make it so pwede masearch pati ang starting year sa academic year -->
                      </div>
                </div>
                <br>
            <!--table-->
            <table class="table table-data table-hover">
              <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Strand</th>
                  <th>Course</th>
                  <th>College</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $result = reservation();
                  foreach ($result as $i) {
                    echo "<tr>";
                    echo "<td>".$i['name']."</td>";
                    echo "<td>".$i['strand']."</td>";
                    echo "<td>".$i['courseCode']."</td>";
                    echo "<td>".$i['collegeCode']."</td>";
                    echo "<td>".$i['status']."</td>";
                    echo "<td><button href='reservation_listByCourse.php' class='btn btn-success glyphicon glyphicon-search btn-sm' type='button' data-toggle='modal' data-target='#viewReserve' title='View Reservation List'></button>
                          <a href='reservation_printByCourse.php' class='btn btn-primary glyphicon glyphicon-print btn-sm' type='button' title='Print Reservation List'></a>
                          </td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
            <!--#end table-->
        </div>
      </div>
    </section>


    <!--Footer-->
    <?php include "includes/footer.php";?>
    <!--#end Footer-->

    <!-- Modals -->
    <div class="modal" id="reserveSlot" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- admin_addAdmin.php -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewReserve" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <!-- reservation_listByCourse.php -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="reserveSlot1" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- reservation_listByCourse.php -->
        </div>
      </div>
    </div>




  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="script_filterSearch.js"></script>

    <script>
      //for textfield populate
      $(function(){
        $(document).on('click', '.btn-add', function(e){
          e.preventDefault();

          var controlForm = $('.controls form:first'),
              currentEntry = $(this).parents('.entry:first'),
              newEntry = $(currentEntry.clone()).appendTo(controlForm);

          newEntry.find('input').val('');
          controlForm.find('.entry:not(:last) .btn-add')
              .removeClass('btn-add').addClass('btn-remove')
              .removeClass('btn-success').addClass('btn-danger')
              .html('<span class="glyphicon glyphicon-minus"></span>');
      }).on('click', '.btn-remove', function(e){
        $(this).parents('.entry:first').remove();

    e.preventDefault();
    return false;
    });
    
});

//for time
 $(document).ready(function() {        
    function ShowTime() {
        var now = new Date();
        var diff = -2;
        var nowTwo = new Date(now.getTime() + diff*60000);  
        var mins = 59-nowTwo.getMinutes();
        var secs = 59-nowTwo.getSeconds();
        timeLeft = "" +mins+'m '+secs+'s';
        $("#auctioncountdown").html(timeLeft);
        if ($("#auctioncountdown").html() === "0m 1s") {
          location.reload(true)
        };
    };
    function StopTime() {
        clearInterval(countdown);   
    }
    ShowTime();
    var countdown = setInterval(ShowTime ,1000);
  });
    </script>


  </body>  
</html>
