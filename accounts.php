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
  <title>Accounts</title>
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
      <nav class="breadcrumb"  style="background-color: white;">
        <div class="col-md-11" style="padding: 10px;">
          <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
          <span class="breadcrumb-item active">Accounts</span>
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
              <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
            </div>
            
          </div>



          <div class="col-md-9">
            <!--Academic Year Setting-->
            <div class="panel panel-default">
              <div class="panel-heading col-md-12" style="margin-bottom: 1%; background-color: #cc6666;">
                <h3 class="panel-title" style="color: white;">Manage Accounts</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4">
                    <select class="form-control search-filter" data-table="table-data" name="college" id="college">
                      <option value="">All Accounts</option>
                      <option value="admin">Admin</option>
                      <option value="chairperson">Chairperson</option>
                    </select>
                  </div>
                  <div class="col-md-4" align="right">
                    <div align="right">
                      <input class="form-control search-filter" type="search" data-table="table-data" placeholder="Filter search...">
                    </div>
                  </div>
                  <div class="col-md-4" align="right">
                    <button class="btn text-white" type="button" data-toggle="modal" data-target="#addAccount" title="Add Account" style="background-color: #cc6666; border-color: #ffffff">Add New Account</button>
                  </div>
                </div>
                <br>
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
    <!-- new acc -->
    <div class="modal" id="addAccount" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New Account</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form action="" method="post" id="form-addaccount">

              <div class="form-group col-md-12">
                <label for="coursecode">Name</label>
                <input type="text" class="form-control" id="adminName" name="adminName" required />
              </div>

              <div class="form-group col-md-6">
                <label for="coursename">Username</label>
                <input type="text" class="form-control" id="adminUser" name="adminUser" required />
              </div>

              <div class="form-group col-md-6">
                <label for="strand">Password</label>
                <input type="password" class="form-control" id="password" name="password" required />
              </div>

              <div class="form-group col-md-12">
                <label for="strand">Role</label>
                <select class="form-control" name="role" required="required" id="role" onchange="showDiv('hiddenChair', this)">
                  <option selected disabled hidden>Role</option>
                  <option value="admin">Admin</option>
                  <option value="chairperson">Chairperson</option>
                </select> 
              </div> 
              
              
                <div class="form-group col-md-12" id="hiddenChair" style="display: none;">
                  <label for="dept">Department</label>
                  <select class="form-control" name="dept" required="required" id="dept">
                    <?php
                    include('config/config.php');   
                    $result = $pdo->prepare('SELECT * FROM department WHERE "deptCode" NOT IN (SELECT "deptCode" FROM department
                      JOIN chairperson using ("deptCode"))');
                    $result->execute();
                    echo '<option selected disabled hidden>Select Department</option>';
                    for($i=0; $row = $result->fetch(); $i++){
                      echo '<option value="'.$row['deptCode'].'">'.$row['deptName'].'</option>';
                    }
                    ?>
                  </select> 
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



    <!-- edit acc -->
    <div class="modal" id="editAccount" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit College</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form action="" method="post" id="form-editaccount">

              <input type="hidden" name="acc_id" id="acc_id">

              <div class="row">
                <div class="form-group col-md-6">
                <label for="coursename">Name</label>
                <input type="text" class="form-control" id="eadminName" name="eadminName" required />
              </div>

              <div class="form-group col-md-6">
                <label for="strand">Username</label>
                <input type="text" class="form-control" id="eadminUser" name="eadminUser" required />
              </div>
              </div>

              <div class="row">
                <div class="form-group col-md-12">
                <label for="strand">Role</label>
                <select class="form-control" name="erole" required="required" id="erole" onchange="showDiv('hidChair', this)">
                  <option selected disabled hidden>Role</option>
                  <option value="admin">Admin</option>
                  <option value="chairperson">Chairperson</option>
                </select> 
              </div> 
              </div>
              
                <div class="row">
                  <div class="form-group col-md-12 deptdiv" id="hidChair">
                  <label for="dept">Department</label>
                  <select class="form-control" name="edept" id="edept">
                    <?php 
                    $result = $pdo->prepare('SELECT * FROM department');
                    $result->execute();
                    for($i=0; $row = $result->fetch(); $i++){
                      echo '<option value="'.$row['deptCode'].'">'.$row['deptName'].'</option>';
                    }
                    ?>
                  </select> 
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
        showAccount();

        function showAccount(){
          $.ajax({
            url: "action.php",
            type: "POST",
            data: {action:"viewaccount"},
            success:function(response){
              $("#showUser").html(response);
              $("table").dataTable({
                "dom": '<"top"l>rt<"bottom"ip><"clear">'
              });
            }
          });
        }

  //insert ajax request
  $("#insert").click(function(e){
    var name = $("#adminName").val();
    var user = $("#adminUser").val();
    var password = $("#password").val();
    var role = $("#role").val();
    var dept = $("#dept").val();

    if(name == '' || user == '' || password == '' || role == ''){
      Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: 'Looks like you missed some fields. Please try again!',
        footer: '<a href>Why do I have this issue?</a>'
      })
    }else{
      if($("#form-addaccount")[0].checkValidity()){
        e.preventDefault();
        $.ajax({
          url: "action.php",
          type: "POST",
          data: $("#form-addaccount").serialize()+"&action=insertaccount",
          success:function(response){
            data = response;
            console.log(data);
            if(data = true){
              Swal.fire({
                title: 'You have successfully added the account with username: ' + name,
                icon: 'success'
              })
              $("#addAccount").modal('hide');
              $("#form-addaccount")[0].reset();
              showAccount();
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: "You're entering a duplicate!"
              });
              $("#form-addaccount")[0].reset();
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
    $("#acc_id").val(b[0]);
    $("#eadminName").val(b[3]);
    $("#eadminUser").val(b[1]);
    $("#erole").val(b[2]);
    if(b[2] == "chairperson"){
      $("#edept").val(b[4]);
      $(".deptdiv").show();
    } else {
      $(".deptdiv").hide();
    }
   })

    //update ajax request
    $("#update").click(function(e){
      var ida = $("#acc_id").val();
      var euser = $("#euserAdmin").val();
      var erole = $("#erole").val();
      if(erole == 'chairperson'){
        var edept = $("#edept").val();
      }

      if(ida =='' || euser == '' || erole == ''){
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Looks like you missed some fields. Please try again!'
        })
      }else{

        if($("#form-editaccount")[0].checkValidity()){
          e.preventDefault();
          $.ajax({
            url: "action.php",
            type: "POST",
            data: $("#form-editaccount").serialize()+"&action=updateaccount",
            success:function(response){
                Swal.fire({
                  title: 'You have successfully updated the account with the username' + euser,
                  icon: 'success'
                })
                $("#editAccount").modal('hide');
                $("#form-editaccount")[0].reset();
                showAccount();
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
      ida = b[0];
      var message = "You are about to delete the account with username <br><h5>" +b[1] + "</h5>";
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
            data:{ida:ida},
            success:function(response){
              if(response = true){
                tr.css('background-color', '#ff6666');
                Swal.fire(
                  'Deleted!',
                  'You have deleted the account with username ' + b[1],
                  'success'
                  )
                showAccount();
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

  });

function showDiv(divId, element){
  document.getElementById(divId).style.display = element.value == 'chairperson' ? 'block' : 'none';
}

function checkPass(){
var password = document.getElementById('password');
var confirm  = document.getElementById('confpassword');
var message = document.getElementById('confirm-message');

var good_color = "#66cc66";
var bad_color  = "#ff6666";

if((password.value == confirm.value) && (password.value != "") && (confirm.value != "")){
  confirm.style.backgroundColor = good_color;
  message.style.color           = good_color;
  message.innerHTML             = '<span class="glyphicon glyphicon-ok"> </span><label> Passwords Match!</label>'; 
} else if(password.value != confirm.value){
  confirm.style.backgroundColor = bad_color;
  message.style.color           = bad_color;
  message.innerHTML             = '<span class="glyphicon glyphicon-remove"> </span><label> Passwords Do Not Match!</label>';
  } else{
    confirm.style.backgroundColor   = "#ffffff";
    message.innerHTML             = "";
                    
  }
}


  </script>
</body>
</html>
