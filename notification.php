<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once("includeThis/adFunction.php");

$user = htmlspecialchars($_SESSION["username"]);
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
    <title>Notification</title>
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


    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb"  style="background-color: white;">
          <div class="col-md-12" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
            <span class="breadcrumb-item active">Notification</span>
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
              <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Course </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
              <a href="notification.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a>
            </div>
            
          </div>

          <div class="col-md-9">
            <!--Academic Year Setting-->
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #cc6666">
                <h3 class="panel-title" style="color: white" >Notification</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4">
                      <input class="form-control search-filter" type="search" data-table="table-data" placeholder="Filter search...">
                    </div>
                    <div class="col-md-8" align="right">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#createNotif" title="Add New Admin" style="background-color: #cc6666; border-color: #cc6666;">Create Notification</button>
                    </div>
                  </div>
                </div>
                <br>
                <table class="table table-data table-hover" id=myTable>
                  <thead>
                    <tr>
                      <th>Sender</th>
                      <th>Receiver</th>
                      <th>Subject</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $notifView = viewNotif();
                    foreach($notifView as $row) {
                      if($row['status'] = false){
                        echo "<tr style='font-weight: bold'>";
                        echo "<td>".$row['sender']."</td>";
                        echo "<td>".$row['receiver']." Department</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".date('F j, Y, g:i a', strtotime($row['date']))."</td>";
                        echo "<td><button class='btn btn-primary' type='button' title='View Notification' href='notif_viewAdmin.php?id=".$row['id']."' data-toggle='modal' data-target='#notifMe'>View</button> <a class='btn btn-danger' href='includeThis/notif_delete.php?id=".$row['id']."'>Delete</a></td>";
                        echo "</tr>";
                      } else if($row['status'] = true) {
                        echo "<tr>";
                        echo "<td>".$row['sender']."</td>";
                        echo "<td>".$row['receiver']." Department</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".date('F j, Y, g:i a', strtotime($row['date']))."</td>";
                        echo "<td><button class='btn btn-primary' type='button' title='View Notification' href='notif_viewAdmin.php?id=".$row['id']."' data-toggle='modal' data-target='#notifMe'>View</button> <a class='btn btn-danger' href='includeThis/notif_delete.php?id=".$row['id']."'>Delete</a></td>";
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
      </div>
    </section>


    <!--Footer-->
    <?php include "includes/footer.php";?>
    <!--#end Footer-->

    <!-- Modals -->
    <div class="modal" id="createNotif" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
           <?php
            $username = 'admin';//urldecode($_GET['username']);

            $result = $pdo->prepare("SELECT *
                                      FROM department");
            $result->execute();
            
          ?>

          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create Notification</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>

          <div class="modal-body">
            <form action="includeThis/notifyme.php" method="post">

              <input type="hidden" name="username" value="<?php echo $username ?>">

              <div class="form-group">
                <label>Notification Title</label>
                <input type="text" name="title" class="form-control" placeholder="Notification Title">
              </div>

              <div class="form-group">
                <label>Notification Body</label>
                  <textarea name="editor" class="form-control" placeholder="Notification Body"></textarea>
              </div>

              <div class="form-group">
                <label>Send To</label>
                  <input type="text" name="rec" class="form-control col-md-12" id="tagstype"  required />
              </div>
              
<!--               <div class="form-group col-md-6">
                <p id="confirm-message"></p>
              </div> -->

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="">Close</button>
                <button type="submit" class="btn btn-primary">Notify</button>
              </div>


  </form>

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
