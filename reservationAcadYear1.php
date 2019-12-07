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

    <!--header-->
    <?php include "includes/header.php";?>
    <!--#end header-->

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <!--breadcrumb-->
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="reservation.php">Reservation</a></li>
          <li class="active">Settings</li>
        </ol>
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
              <a href="reservation.php" class="list-group-item active" style="background-color: #cc6666; border-color: #cc6666"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation <span class="badge">12</span></a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Course <span class="badge">33</span></a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College <span class="badge">5</span></a>
              <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admin <span class="badge">203</span></a>
            </div>

            <!-- under sidebar: disk space, bandwidth -->
            <?php include "includes/underSideBar.php";?>
            <!-- #end under sidebar: disk space, bandwidth -->


          </div>



          <div class="col-md-9">
            <!--Academic Year Setting-->
              <div class="panel panel-default">
                <div class="panel-heading col-md-12" style="margin-bottom: 1%; background-color: #cc6666">
                <div class="menu-item col-md-11">
                  <h3 class="panel-title" style="color: white;">Academic Year</h3>
                </div>
                <div class="btn-group dropleft col-md-1">
                  <a class="nav-link" href="" data-toggle="dropdown"> <span class="glyphicon glyphicon-option-vertical" style="color: white;"></span> </a>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item" href="#reservation_activateAY.php" role="button" data-toggle="modal" data-target="#addAY">Edit Current AY</a>
                        <a class="dropdown-item" href="reservation_activateAY.php" role="button" data-toggle="modal" data-target="#addAY">Add AY</a>
                      </li>
                    </ul>
                </div>
              </div>

                <div class="panel-body" style="margin-top: 50px;">
                  <ul class="list-inline">
                    <div class="box-icon col-md-2">
                        <label class="col-md-3" style="margin-top: 5px;">Status:</label>
                      </div>
                      <div class="box-icon col-md-3">
                        <select class="form-control" onchange="changeoptions()" name="college" id="college">
                          <option default>Active</option>
                          <option>Never Activated</option>
                          <option>Deactivated</option>
                        </select>
                      </div>
                  </ul>
                  
                  <div class="container col-md-12" style="margin-top: 30px;">
                    <!--title here-->
                    <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Academic Year</th>
                        <th>Reservation Start</th>
                        <th>Reservation End</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2019-2020</td>
                        <td>May 24, 2019</td>
                        <td>May 30, 2019</td>
                      </tr>
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
    <div class="modal fade" id="addAY" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- reservation_activateAY.php -->
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
