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
  <title>Course</title>
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

  <!-- breadcrumb -->
  <section id="breadcrumb">
    <div class="container">
      <nav class="breadcrumb col-md-12"  style="background-color: white;">
        <div class="col-md-12" style="padding: 10px;">
          <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
          <a class="breadcrumb-item" href="courseOffers.php">Offered Courses</a>
          <span class="breadcrumb-item active">Manage Courses</span>
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
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard
            </a>
            <a href="reservation.php" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
            <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
            <a href="course.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
            <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
            <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
            <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
            <!-- <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a> -->
          </div>


        </div>


        <div class="col-md-9">
          <!--Manage Courses-->
          <!--remove ang department from selections, but put department on the table-->
          <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #cc6666;">
              <h3 class="panel-title" style="color: white;">Manage Courses</h3>
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
                <div class="col-md-8" align="right">
                  <!-- <input class="form-control search-filter" type="search" data-table="table-data" placeholder="Filter search..."> -->
                  <!-- make it so pwede masearch pati ang starting year sa academic year -->
                  <button type="button" class="btn btn-primary m-1 float-right text-white addBtn" data-toggle="modal" data-target="#addCourse" style="background-color: #cc6666; border-color: #ffffff">Add New Course</button>
                </div>
              </div>
              <br>

              <div class="table-responsive" id="showTable">
              </div>
            </div>
          </div>
        </div>
      </section>

      <!--Footer-->
      <?php include "includes/footer.php";?>
      <!--#end Footer-->

      <!-- Modals -->
      <!-- OFFER COURSE -->
      <div class="modal" id="addCourse" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add New Course</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
              <form action="" method="post" id="form-addcourse">

                <div class="form-group col-md-4">
                  <label for="coursecode">Course Code  </label>
                  <input type="text" class="form-control" id="code" name="code" placeholder="Course Code" required />
                </div>

                <div class="form-group col-md-8">
                  <label for="coursename">Course Name  </label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Course Name" required />
                </div>

                <div class="form-group col-md-4">
                  <label for="strand">Strand</label>
                  <input type="text" class="form-control" id="strand" name="strand" placeholder="Strand" required />
                </div> 

                <div class="form-group col-md-8">
                  <label for="Department">Department  </label>
                  <select class="form-control" name="dept" required="required" id="dept">
                    <?php
                    include('config/config.php');   
                    $result = $pdo->prepare("SELECT \"deptCode\", \"deptName\" FROM department");
                    $result->execute();
                    for($i=0; $row = $result->fetch(); $i++){
                      echo '<option value="'.$row['deptCode'].'">'.$row['deptName'].'</option>';
                    }
                    ?>
                  </select> 
                </div>

              </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
              <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
              <input type="submit" name="submit" id="submit" value="Add" class="btn btn-primary" />
            </div>  

          </div>
        </div>
      </div>

      <!-- OFFER COURSE -->
      <div class="modal" id="editCourse" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Course</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
              <form action="" method="post" id="form-editcourse">

                <input type="hidden" class="form-control" id="ocode" name="ocode" />

                <div class="form-group col-md-4">
                  <label for="coursecode">Course Code</label>
                  <input type="text" class="form-control" id="ecode" name="ecode" placeholder="Course Code" />
                </div>

                <div class="form-group col-md-8">
                  <label for="coursename">Course Name</label>
                  <input type="text" class="form-control" id="ename" name="ename" placeholder="Course Name" />
                </div>

                <div class="form-group col-md-4">
                  <label for="strand">Strand</label>
                  <input type="text" class="form-control" id="estrand" name="estrand" placeholder="Strand" />
                </div> 

                <div class="form-group col-md-8">
                  <label for="Department">Department  </label>
                  <select class="form-control" name="edept" id="edept">
                    <?php   
                    $result = $pdo->prepare("SELECT \"deptCode\", \"deptName\" FROM department");
                    $result->execute();
                    for($i=0; $row = $result->fetch(); $i++){
                      echo '<option value="'.$row['deptCode'].'">'.$row['deptName'].'</option>';
                    }
                    ?>
                  </select> 
                </div>

              </form>
            </div>
            <!-- Modal Footer -->
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
          showCourse();

          function showCourse(){
            $.ajax({
              url: "action.php",
              type: "POST",
              data: {action:"viewcourse"},
              success:function(response){
              //console.log(response);
              $("#showTable").html(response);
              $("table").dataTable({
                "dom": '<"top"l>rt<"bottom"ip><"clear">'

              });
            }
          });
          }

      //insert ajax request
      $("#submit").click(function(e){
        var code = $("#code").val();
        var name = $("#name").val();
        var dept = $("#dept").val();
        var strand = $("#strand").val();

        if(code =='' || name =='' || dept == '' || strand == ''){
          Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Looks like you missed some fields. Please try again!',
            footer: '<a href>Why do I have this issue?</a>'
          })
        }else{
          if($("#form-addcourse")[0].checkValidity()){
            console.log("working in checkValidity");
            e.preventDefault();
            $.ajax({
              url: "action.php",
              type: "POST",
              data: $("#form-addcourse").serialize()+"&action=addcourse",
              dataTye: 'json',
              success:function(response){
                console.log("working inside response");
                var values = [];

for(var k in response){
  values.push(response[k]);
}
console.log(values);
                if(response = true){
                  console.log("working inside true");
                  Swal.fire({
                    title: 'You have successfully added the course ' + name,
                    icon: 'success'
                  })
                  $("#addCourse").modal('hide');
                  $("#form-addcourse")[0].reset();
                  showCourse();
                } else {
                  console.log("working inside false");
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: "You're entering a duplicate!"
                  });
                  $("#form-addcourse")[0].reset();


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
        $("#ocode").val(b[0]);
        $("#ecode").val(b[0]);
        $("#ename").val(b[1]);
        $("#edept").val(b[3]);
        $("#estrand").val(b[2]);
      });


      //update ajax request
      $("#update").click(function(e){
        var code = $("#ecode").val();
        var name = $("#ename").val();
        var dept = $("#edept").val();
        var strand = $("#estrand").val();
        var ocode = $("#ocode").val();

        if(code =='' || name =='' || dept == '' || strand == '' || ocode == ''){
          Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Looks like you missed some fields. Please try again!'
          })
        }else{
          if($("#form-editcourse").serialize()!= ''){
            if($("#form-editcourse")[0].checkValidity()){
              e.preventDefault();
              $.ajax({
                url: "action.php",
                type: "POST",
                data: $("#form-editcourse").serialize()+"&action=editcourse",
                success:function(response){
                  data = response;
                  console.log(data);
                  if(data = true){
                    Swal.fire({
                      title: 'You have successfully updated the course ' + name,
                      icon: 'success'
                    })
                    showCourse();
                    $("#editCourse").modal('hide');
                    $("#form-editcourse")[0].reset();
                  } else if(data = false) {
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'Change is not implemented'
                    })
                    $("#form-editcourse")[0].reset();
                  }
                }
              });
            }
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops!',
              text: 'Empty Fields!'
            })
          }
        }
      });

      //delete ajax
      $("body").on("click", ".delBtn", function(e){
        e.preventDefault();
        var tr = $(this).closest('tr');
        var rfco = $(this).attr('id');
        a = decodeURIComponent(rfco);
        b = a.split("=");
        idc = b[0];
        var message = "You are about to delete the course <br><h5>" + b[1] + "<br></h5> permanently.";
        Swal.fire({
          title: "Are you sure?",
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
              data:{idc:idc},
              success:function(response){
                if(response = true){
                  tr.css('background-color', '#ff6666');
                  Swal.fire(
                    'Deleted!',
                    'You have deleted the course <br><h5>' + b[1] + '<br></h5>.',
                    'success'
                    )
                  showCourse();
                } else if (response = false){
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




    })
  </script>
</body>
</html>
