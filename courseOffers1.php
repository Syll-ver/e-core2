<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Area | Course</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <style>
  .dropdown-menu {
 
    left:auto;
  right:75%;
  top:18;
  
}
</style>
  <body>

    <!--header-->
    <?php include "includes/header.php";?>
    <!--#end header-->

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="index.php">Dashboard</a></li>
          <li><a href="reservation.php">Reservation</a></li>
          <li class="active">Offered Courses</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="index.php" class="list-group-item">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
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

            <!--Manage Course Offerings-->
            <!--remove ang department from selections, but put department on the table-->
            <div class="panel panel-default">
              <div class="panel-heading col-md-12" style="margin-bottom: 1%; background-color: #cc6666; border-color: #cc6666">
                <div class="col-md-11">
                  <h3 class="panel-title" style="margin-top: 1%; color: white;">Manage Offered Courses</h3>
                </div>
                <div class="col-md-1">
                  <div class="dropdown">
                    <a class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="glyphicon glyphicon-option-vertical" style="color: white"></span> </a>
                    <ul class="dropdown-menu" >
                      <li>
                        <a href="course_offerAdd.php" type="button" data-toggle="modal" data-target="#offerAdd">Offer Course</a>
                        <a href="course_offerRemove.php" type="button" data-toggle="modal" data-target="#offerRemove">Remove Course</a>
                        <a href="course_Setcutoff.php" type="button" data-toggle="modal" data-target="#offerRemove">Set Multiple Courses CO-scores</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                      <div class="col-md-10">
                        <input class="form-control" type="text" placeholder="Filter Courses...">
                      </div>
                      <form method="POST">
                        <div class="box-icon col-md-3">
                          <?php include "includes/selection_college.php";?>
                        </div>
                </form>
                </div>
                <br>
                <table class="table table-hover">
                      <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        <th>Department</th>
                        <th>Strand</th>
                        <th>SASE</th>
                        <th>AP</th>
                        <th>LU</th>
                        <th>MA</th>
                        <th>SC</th>
                        <th>Slots</th>
                        <th></th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>BS Information Technology</td>
                        <td>IT/Physics</td>
                        <td>STEM</td>
                        <td>90</td>
                        <td>-</td>
                        <td>-</td>
                        <td>13</td>
                        <td>-</td>
                        <th>30</th>
                        <td><button href="course_offerEdit.php" class="btn btn-default" type="button"
                          data-toggle="modal" data-target="#offerEdit">Edit</button></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>BS Mathematics</td>
                        <td>Mathematics</td>
                        <td>STEM</td>
                        <td>95</td>
                        <td>-</td>
                        <td>-</td>
                        <td>15</td>
                        <td>-</td>
                        <th>30</th>
                        <td><a class="btn btn-default" href="edit.html">Edit</a></td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>BS Biology</td>
                        <td>Science</td>
                        <td>STEM</td>
                        <td>90</td>
                        <td>-</td>
                        <td>-</td>
                        <td>13</td>
                        <td>15</td>
                        <th>35</th>
                        <td><a class="btn btn-default" href="edit.html">Edit</a></td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>BS Agricultural and Biosystems Engineering</td>
                        <td>Agricultural Engineering</td>
                        <td>STEM</td>
                        <td>90</td>
                        <td>-</td>
                        <td>-</td>
                        <td>15</td>
                        <td>-</td>
                        <th>25</th>
                        <td><a class="btn btn-default" href="edit.html">Edit</a></td>
                      </tr>
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
    <div class="modal fade" id="offerAdd" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- course_offerAdd.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="offerRemove" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- course_offerRemove.php -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="offerEdit" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- course_addCourse.php -->
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

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
