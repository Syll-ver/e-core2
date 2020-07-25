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
  <link href="assets/css/styles.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet">
  <!-- <link href="assets/js/bootstrap.js" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
  <link rel="stylesheet" href="sweetalert2.min.css">
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
                    <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal" style="background-color: #cc6666; border-color: #ffffff">Add New Deprtment</button>
                  </div>
                  <hr style="color: black;">
                </div>
                <br />
                <!--title here-->
                <div class="table-responsive" id="showUser">


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
<!-- new dept -->
    <div class="modal" id="addModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Department</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form action="" method="post" id="form-data">

              <div class="form-group">
                <label for="ccode">College</label>
                <select class="form-control" name="ccode"  id="ccode" required>
                  <?php
                   include('config/config.php');   
                    $result = $pdo->prepare('SELECT * FROM college');
                    $result->execute();
                    for($i=0; $row = $result->fetch(); $i++){
                    echo '<option value="'.$row['collegeCode'].'">'.$row['collegeName'].'</option>';
                    }
                  ?> 
                </select> 
              </div> 

              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="dcode">Department Code</label>
                  <input type="text" class="form-control" id="dcode" name="dcode" placeholder="Department Code" required />
                </div>

                <div class="form-group col-md-8">
                  <label for="dname">Department Name</label>
                  <input type="text" class="form-control" id="dname" name="dname" placeholder="Deparment Name" required />
                </div>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
            <input type="submit" name="insert" id="insert" value="Add" class="btn btn-primary" />
          </div>  
        </div>
      </div>
    </div>



    <!-- edit dept -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Department</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="" method="post" id="edit-form-data">
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                          <label for="ccode">College</label>
                          <select class="form-control" name="eccode"  id="eccode" required>
                            <?php 
                              $result = $pdo->prepare('SELECT * FROM college');
                              $result->execute();
                              for($i=0; $row = $result->fetch(); $i++){
                              echo '<option value="'.$row['collegeCode'].'">'.$row['collegeName'].'</option>';
                              }
                            ?>
                          </select> 
                        </div> 

                        <div class="row">
                            <div class="form-group col-sm-4">
                              <label for="edcode">Department Code</label>
                              <input type="text" class="form-control" id="edcode" name="edcode" required />
                            </div>

                            <div class="form-group col-md-8">
                              <label for="edname">Department Name</label>
                              <input type="text" class="form-control" id="edname" name="edname" required />
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
                    <input type="submit" name="update" id="update" value="Update" class="btn btn-primary" />
                </div>  
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
    showDept();

    function showDept(){
      $.ajax({
        url: "action.php",
        type: "POST",
        data: {action:"view"},
        success:function(response){
          // console.log(response);
          $("#showUser").html(response);
          $("table").dataTable({
            "dom": '<"top"l>rt<"bottom"ip><"clear">'
          });
        }
      });
    }

        //insert ajax request
        $("#insert").click(function(e){
          var ccode = $("#ccode").val();
          var dcode = $("#dcode").val();
          var dname = $("#dname").val();

          if(ccode == '' || dcode == '' || dname == ''){
                    // swal("Oops!!", "Looks like you missed some fields. Please try again!", "error");
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'Looks like you missed some fields. Please try again!',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
                  }else{

                    if($("#form-data")[0].checkValidity()){
                      e.preventDefault();
                      $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize()+"&action=insert",
                        success:function(response){
                          data = response;
                          console.log(data);
                          if(data = true){
                            Swal.fire({
                              title: 'You have successfully added the ' + dname + ' department',
                              icon: 'success'
                            })
                            $("#addModal").modal('hide');
                            $("#form-data")[0].reset();
                            showDept();
                          } else {
                            Swal.fire({
                              icon: 'error',
                              title: 'Oops!',
                              text: "You're entering a duplicate!"
                            });
                            $("#form-data")[0].reset();
                          }

                        }
                      });
                    }
                  }
                })


        $("body").on("click", ".editBtn", function(e){
          e.preventDefault();
          var edit_id = $(this).attr('id');
          a = decodeURIComponent(edit_id);
          b = a.split("=");
          console.log(b);
          $("#id").val(b[0]);
          $("#eccode").val(b[1]);
          $("#edcode").val(b[0]);
          $("#edname").val(b[2]);
        })


        

            //update ajax request
            $("#update").click(function(e){
              var id = $("#id").val();
              var ccode = $("#eccode").val();
              var dcode = $("#edcode").val();
              var dname = $("#edname").val();

              if(id =='' || ccode == '' || dcode == '' || dname == ''){
                    // swal("Oops!!", "Looks like you missed some fields. Please try again!", "error");
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'Looks like you missed some fields. Please try again!'
                    })
                  }else{

                    if($("#edit-form-data")[0].checkValidity()){
                      e.preventDefault();
                      $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#edit-form-data").serialize()+"&action=update",
                        success:function(response){
                                //data = response;
                                console.log(response);
                                //if(data = true){
                                  Swal.fire({
                                    title: 'You have successfully updated the ' + dname + ' department',
                                    icon: 'success'
                                  })
                                  $("#editModal").modal('hide');
                                  $("#edit-form-data")[0].reset();
                                  showDept();
                                }
                              });
                    }
                  }
                })


            //delete ajax
            $("body").on("click", ".delBtn", function(e){
              e.preventDefault();
              var tr = $(this).closest('tr');
              del_id = $(this).attr('id');
              a = decodeURIComponent(del_id);
              b = a.split("=");
              idd = b[0];
              var message = "You are about to delete the department: <br><h5>" +b[2] + "</h5>";
              Swal.fire({
                title: 'Are you sure?',
                html: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
              }).then((result) => {
                if(result.value){
                  $.ajax({
                    url:"action.php",
                    type:"POST",
                    data:{idd:idd},
                    success:function(response){
                      console.log(response);
                      if(response != false){
                        tr.css('background-color', '#ff6666');
                        Swal.fire(
                          'Deleted!',
                          'You have deleted the ' + b[2] + ' department',
                          'success'
                          )
                        showDept();
                      } else if (response == false){
                        Swal.fire(
                          'Oops!',
                          'Error in deleting!',
                          'error'
                          )
                      }
                    }
                  });
                }
              });
            });

          });
        </script>
      </body>
      </html>
