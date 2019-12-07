<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//include_once("config/config.php");
include ("includeThis/adFunction.php");
$user = htmlspecialchars($_SESSION["username"]);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Offered Courses | Course</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/bootstrap.js" rel="stylesheet">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/typeahead.css">

    <link href="assets/css/tagmanager.css" rel="stylesheet">
    <script type="text/javascript" src="assets/js/tagmanager.js"></script>
    <script src="assets/js/bootstrap3-typeahead.min.js"></script>
  </head>
  <body>

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <!--breadcrumb-->
    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb col-md-12"  style="background-color: white;">
          <div class="col-md-12" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <span class="breadcrumb-item active">Manage Offered Courses</span>
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
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
              </a>
              <a href="reservation.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
              <a href="courseOffers.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
            </div>

          </div>

          
          <div class="col-md-9">

            <!--Manage Course Offerings-->
            <!--remove ang department from selections, but put department on the table-->
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #cc6666; border-color: #cc6666">
                <h3 class="panel-title" style="color: white;">Manage Offered Courses</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <form method="POST">
                      <div class="box-icon">
                        <select class="form-control search-filter" data-table="table-data" name="college" id="college">
                        <?php
                        $college = selectCollege();
                        ?>
                    </select>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-3">
                  </div>
                  <div class="col-md-5" align="right">
                    <!-- <button class="btn btn-primary" href="c_setCutOff.php?id=<?php echo urlencode($user) ?>" data-toggle="modal" data-target="#setCutOff" style="background-color: #cc6666; border-color: #ffffff">Set Cut-Off Scores</button> -->
                    <button class="btn btn-primary" data-toggle="modal" href="course_offerAdd.php" data-target="#setCutOff" style="background-color: #cc6666; border-color: #ffffff">Offer Course</button>
                  </div>
                </div>
                <br>
                <table class="table table-data table-hover">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th style="display: none">Year</th>
                        <th>Course Name</th>
                        <th>Department</th>
                        <th>College</th>
                        <th>Strand</th>
                        <th>SASE</th>
                        <th>AP</th>
                        <th>LU</th>
                        <th>MA</th>
                        <th>SC</th>
                        <th>Slots</th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                      $result = courseOffers();
                      $counter = 1;
                      foreach($result as $row){
                        echo "<tr>";
                        echo "<td>".$counter."</td>";
                        echo "<th style='display: none'>".$row['acadYear']."</th>";
                        echo "<td>".$row['courseName']."</td>";
                        echo "<td>".$row['deptCode']."</td>";
                        echo "<td>".$row['collegeCode']."</td>";
                        echo "<td>".$row['strand']."</td>";
                        echo "<td>".$row['GR_criteria']."</td>";
                        echo "<td>".$row['AP']."</td>";
                        echo "<td>".$row['LU']."</td>";
                        echo "<td>".$row['MA']."</td>";
                        echo "<td>".$row['SC']."</td>";
                        echo "<td>".$row['slot']."</td>";
                        echo "<td> <button href='cutoff_edit.php?code=".urlencode(http_build_query($row))."' class='btn btn-primary' type='button' data-toggle='modal' data-target='#offerEdit' title='Edit Course'>Edit</button> <a class='btn btn-danger' href='includeThis/courseoffer_del.php?id=".urlencode($row['courseCode'])."'>Delete</a></td>";
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

    <div class="modal" id="offerRemove" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- course_offerRemove.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="offerEdit" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- course_offerRemove.php -->
        </div>
      </div>
    </div>

    <div class="modal" id="offerAdd" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Offer Courses</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body" id="modalbody">
            <form name="offer" method="post" action="includeThis/offer_add.php">
              <div class="form-group">
                <label>Courses to Offer</label>
                <input type="text" name="rec" class="form-control" id="tagstype" required />
              </div>

              <div class="modal-footer">
                <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
                <input  class="btn btn-success" type="submit" value="Offer" >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Thank you for pre-registering!</h4>
            </div>
            <div class="modal-body">
                <p>Thanks for getting in touch!</p>                     
            </div>    
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
      $(document).ready(function() {
        var tags = $(".tm-input").tagsManager();
        jQuery(".typeahead").typeahead({
          source: function (query, process) {
            return $.get('aj.php', { query: query }, function (data) {
              data = $.parseJSON(data);
              return process(data);
            });
          },
          afterSelect :function (item){
            tags.tagsManager("pushTag", item);
          }
        });
      });

      function checkPass(){
              //Store the password field objects into variables ...
              var password = document.getElementById('tagstype');
              var message = document.getElementById('confirm-message');
              if(password.value != ""){
                  message.innerHTML             = '<b>' + password.value +'</b> naay value!';
              } else{
                  message.innerHTML             = '<b> way value! </b> '
              } 
          }  


        var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
                });

                cb(matches);
            };
            };

            <?php
                $sql = "SELECT * FROM department";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount() > 0){
                    echo "var dept = [";
                    while($row = $stmt->fetch()){
                        echo "'".$row["deptCode"] . "', ";
                    }
                }
                echo "];";
            ?>
            $('#tagstype').tagsinput({
                    typeaheadjs:({
                    hint: true,
                    highlight: false,
                    minLength: 1
                },{
                    name: 'dept',
                    source: substringMatcher(dept)
                })
            });
    </script>
  </body>
</html>
