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
    <!-- <link href="assets/js/bootstrap.js" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
    <link rel="stylesheet" href="sweetalert2.min.css">
    
  </head>

  <body class="">

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <!--breadcrumb-->
    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb col-md-12"  style="background-color: white;">
          <div class="col-md-12" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <span class="breadcrumb-item active">Reservation</span>
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
              <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="reservation.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
              <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
              <!-- <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a> -->
            </div>
          </div>

          <div class="col-md-9">
            <!-- Reservation List View -->
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #cc6666">
                <h4 class="panel-title" style="color: white;">List of Reserved Students</h4>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-7">
                    <select class="form-control search-filter col-md-7" data-table="table-data" name="college" id="college">
                      <?php
                        $college = selectCollege();
                      ?>
                    </select>
                  </div>
                  <div class="col-md-5" align="right">
                    <button class="btn text-white" href="reservation_reserveSlot.php" type="button" data-toggle="modal" data-target="#reserveSlot" style="background-color: #cc6666; border-color: #ffffff">Reserve A Slot</button>
                  </div>
                </div>
                <br>
            <!--table-->
            <div class="table-responsive" id="showTable">
            </div>
            <!--#end table-->
        </div>
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


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/aaae553ee8.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="script_filterSearch.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        showReservation();

        function showReservation(){
          $.ajax({
            url: "action.php",
            type: "POST",
            data: {action:"viewreservation"},
            success:function(response){
               //console.log(response);
              $("#showTable").html(response);
              $("table").dataTable({
                  "dom": '<"top"l>rt<"bottom"ip><"clear">'
                  
                });
            }
          });
        }


        });

      </script>
    

    <script>
      //datatable
      // $(document).ready(function(){
      //   $("table").Datatable();
      // }); 


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
