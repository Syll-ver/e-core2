<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once("includeThis/adFunction.php");

//$acadyear = $pdo->query('SELECT * FROM academic_year');
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
    <title>Reservation | Acad Year</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/bootstrap.js" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <!--breadcrumb-->
    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb col-md-12"  style="background-color: white;">
          <div class="col-md-11" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <a class="breadcrumb-item" href="reservation.php">Reservation</a>
            <span class="breadcrumb-item active">Academic Year</span>
          </div>
      <!-- Breadcrumb Menu-->
          <div class="col-md-1" style="margin-right: 0;">
            <div class="breadcrumb-menu" >
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown" style="background-color: #cc6666;">
                <button class="btn text-white" type="button" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-color: #ffffff; border-radius: .25rem"><span class="glyphicon glyphicon-cog"></span> A.Y. Settings</button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                  <div class="mx-sm-3"><label>AY & Schedule</label></div>
                  <a class="dropdown-item" href="chairperson/c_setCutOff.php" data-toggle="modal" data-target="#setCutOff" title="Add New AY">Add Academic Year</a> <!-- cut off score gyapon ang modal ani -->
                  <a class="dropdown-item" href="reservation_scoreSchedule.php" data-toggle="modal" data-target="#scoreSched" title="Set Score Schedule">Score Scheduling</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="chairperson/c_setCutOff.php" data-toggle="modal" data-target="#setCutOff" title="See Previous Cut-Offs">View Previous Cut-Off Scores</a>
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
              <a href="index.php" class="list-group-item">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="reservation.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Course </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts</a>
              <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a>
            </div>

          </div>



          <div class="col-md-9">
            <!--Academic Year Setting-->
              <div class="panel panel-default">
                <div class="panel-heading col-md-12" style="margin-bottom: 1%; background-color: #cc6666">
                <div class="menu-item">
                  <h3 class="panel-title" style="color: white;">Academic Year</h3>
                </div>
              </div>

                <div class="panel-body" >
                  
                  
                  <div class="container" >
                    <!--title here-->
                    <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Academic Year</th>
                        <th>Reservation Start</th>
                        <th>Reservation End</th>
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
                          echo "<td>".$i['reservationStart']."</td>";
                          echo "<td>".$i['reservationEnd']."</td>";
                          echo "<td>active</td>";
                          echo "<td><button href='reservation_editAY.php' class='btn btn-primary glyphicon glyphicon-edit btn-sm' type='button' data-toggle='modal' data-target='#editAY' title='Edit Academic Year'></button></td>";
                          echo "</tr>";
                        } else if($i['status'] == 0){
                          echo "<tr>";
                          echo "<td>".$i['acadYear']."</td>";
                          echo "<td>".$i['reservationStart']."</td>";
                          echo "<td>".$i['reservationEnd']."</td>";
                          echo "<td>inactive</td>";
                          echo "<td><button href='reservation_editAY.php' class='btn btn-primary glyphicon glyphicon-edit btn-sm' type='button' data-toggle='modal' data-target='#editAY' title='Edit Academic Year'></button></td>";
                          echo "</tr>";
                        }

                      }
                      ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>

              <!--Score Schedule-->
              <div class="panel panel-default">
                <div class="panel-heading col-md-12" style="background-color: #cc6666;">
                  <div >
                    <h3 class="panel-title" style="margin-top: 1%; color: white;">Score Scheduling</h3>
                  </div>
                </div>

                <div class="panel-body" style="margin-top: 50px;">
                  <div class="container col-md-12">
                    <!--title here-->
                   <div class="controls">
                    <form role="form" autocomplete="off">

                    <!-- ARI ANG DIV FOR THE TEXTFIELDS -->
                      <div class="entry input-group col-md-12">
                        <!--THIS ONE FOR SCORE-->
                        <input type="number" placeholder="90" class="form-control" id="score1" style="height: 26px">
                        <div class="input-group-addon"  style="margin-right: -1px; padding-right: 23px; font-size: 13px;"> to </div>
                        <input type="number" placeholder="99" class="form-control" id="score2" style="height: 26px">
                        <!--THIS ONE FOR "ON"-->
                        <div class="input-group-addon" style="margin-right: -1px; padding-right: 23px; font-size: 13px;"> on </div>
                        <!--THIS IS FOR THE START DATE-->
                        <input type="date" class="form-control" id="schedStart" style="height: 26px" >
                        <!--THIS IS FOR "THE"TO"-->
                        <div class="input-group-addon" style="margin-right: -1px; padding-right: 23px; font-size: 13px;"> to </div>
                        <!--THIS IS FOR THE END DATE-->
                        <input class="form-control" name="fields[]" type="date" id="schedEnd"style="height: 26px">

                      
                        <!--THIS SPAN IS FOR THE BUTTON-->
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button" style="height: 26px">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                        <!--END SPAN FOR BUTTON-->
                    </div>
                    <!-- ARI ANG END DIV FOR THE TEXTFIELDS -->
                    
                </form>
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
    <div class="modal" id="setCutOff" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- admin_addAdmin.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="editAY" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- reservation_editAY.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="scoreSched" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <!-- reservation_scoreSchedule.php -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="deactAY" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content panel-warning">
          <!-- reservation_deactAY.php-->
        </div>
      </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
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

    <script>
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
    }).on('click', '.btn-remove', function(e)
    {
    $(this).parents('.entry:first').remove();

    e.preventDefault();
    return false;
    });
    
});
    </script>

  </body>  
</html>
