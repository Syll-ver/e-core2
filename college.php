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
    <title>College</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
    <link href="assets/js/bootstrap.js" rel="stylesheet">s
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
            <span class="breadcrumb-item active">College</span>
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
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
              <!-- <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a> -->
            </div>
          </div>



          <div class="col-md-9">
<!--             <?php
            
            $full = $_SERVER['QUERY_STRING'];
            college_alert($full);

            ?> -->
            <!--Manage Courses-->
            <!--remove ang department from selections, but put department on the table-->


            <div class="panel panel-default">
              <div class="panel-heading mb-3 col-md-12" style="background-color: #cc6666; border-color: #cc6666">
                  <h3 class="panel-title" style="color: white;">College</h3>
              </div>

                <div class="panel-body">
                  <div class="row">                   
                    <div class="col-md-12 mn" align="right">
                      <!-- <button class="btn text-white" type="button" href="college_addCollege.php" data-toggle="modal" data-target="#addCollege" title="Add College" style="background-color: #cc6666; border-color: #ffffff">Add New College</button> -->
                      <button class="btn text-white" type="button" data-toggle="modal" data-target="#addCollege" title="Add College" style="background-color: #cc6666; border-color: #ffffff">Add New College</button>
                    </div>
                  </div>
                    <!--title here-->
                    <table class="table table-hover">
                    <thead>
                      <tr>
                       
                        <th>College Code</th>
                        <th>College Name</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="tbody">
                       <?php
                      $result = college();
                      foreach($result as $row) {
                        echo "<tr>";
                        echo "<td>".$row['collegeCode']."</td>";
                        echo "<td>".$row['collegeName']."</td>";
                        echo "<td> <button href='college_editCollege.php?oldcode=".urlencode(http_build_query($row))."' class='btn btn-primary' type='button' data-toggle='modal' data-target='#editCollege' title='Edit College'>Edit</button> <button class='btn btn-danger delt' name='delt' id='delt' data-id='".$row['collegeCode']."' >Delete</button></td>";
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
    <div class="modal" id="addCollege" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
           <!-- college_addCollege.php -->
           <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add College</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
                  
          <div class="modal-body"> 
            <form role="form" name="addcollege" id="addcollege" autocomplete="off" >
                  <div class="form-group col-md-4">
                    <label for="coursecode">Code</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="College Code" />
                  </div>

                  <div class="form-group col-md-8">
                    <label for="coursename">College Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="College Name" />
                  </div>
            </form>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
            <input class="btn btn-primary" type="submit" name="submit" id="submit" value="Add" data-dismiss="modal"/>
          </div>  
        <!-- </div> -->
      </div>
    </div>
  </div>

    <div class="modal" id="editCollege" role="dialog">
      <div class="modal-dialog modal-md modal-dialog-centered">
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
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="js/tagsinput.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="script_filterSearch.js"></script>
    <script type="text/javascript">

      // function fetch(){
      //   $.ajax({
      //     method: 'POST',
      //     url: 'fetch_college.php',
      //     success: function(response){
      //       $('#tbody').html(response);
      //     }
      //   });
      // }

      // $(window).load(function(){
      //           $('#onload').modal('show');
      //       });

      $("#submit").click(function(){
        var name = $("#name").val();
        var code = $("#code").val();

        if(name == '' || code == ''){
            swal("Oops!!", "Looks like you missed some fields. Please try again!", "error");
        }else{
            $.ajax({
                type:'post',
                url:'includeThis/college_add.php',
                data: {name:name,code:code},
                success:function(result){
                   var json = JSON.parse(result);
                   if(json == true){
                    $('#submit').prop('disabled', true);
                  swal({
                     title: "Success!",
                     text: "You have successfully added " + code + ": " + name,
                     type: "success",
                     confirmButtonText: "Ok",
                     }).then((result) => {
                        if(result.value){
                                //this is your success swal, after clicking the yes button, it will reload or go to the other page.
                                location.reload(); // this is your location reload.
                                window.location.href='college.php'; // this is your relocate to other page.
                         }
                    })
                  // } else {
                  //   // swal("Error adding!", "Please try again", "Error"); 
                  //   swal({
                  //    title: "Error!",
                  //    text: "Please check for error or duplicate with college code " + "\"" + code + "\"",
                  //    type: "error",
                  //    confirmButtonText: "Ok",
                  //    // }).then((result) => {
                  //    //     if(result.value){
                  //    //            //this is your success swal, after clicking the yes button, it will reload or go to the other page.
                  //    //            location.reload(); // this is your location reload.
                  //    //            window.location.href='college.php'; // this is your relocate to other page.
                  //    //     }
                  //   })
                  }
              },
              //di mag work
              error:function(xhr, thrownError, ajaxOptions){
                swal("Error adding!", "Please try again", "Error"); 
              },
            });
        }
    });



    $(document).on('click', '.delt', function(){
    var id = $(this).data('id');
 
    swal({
        title: 'You are about to delete college: ' + id + ".",
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.value){
          $.ajax({
            url: 'includeThis/college_delete.php',
            type: 'POST',
              data: 'id='+id,
          })
          .done(function(response){
            swal({
              title: "Success!",
              text: "You have successfully deleted the college with college code " + id,
              type: "success",
              confirmButtonText: "Ok",
            }).then((result) => {
            if(result.value){
            //this is your success swal, after clicking the yes button, it will reload or go to the other page.
            location.reload(); // this is your location reload.
            window.location.href='college.php'; // this is your relocate to other page.
                         }
                    })
          })
          .fail(function(){
            swal('Oops...', 'Failed deleting college '+ id +'!', 'error');
          });
        }
 
    })
});
    </script>
  </body>
</html>
