<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

include("includeThis/adFunction.php");

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
  <title>Dashboard</title>
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

  <!-- navbar -->
  <?php include "includes/navbar.php";?>
  <!-- #end navbar -->

  <!-- breadcrumb -->
  <section id="breadcrumb">
    <div class="container">
     <nav class="breadcrumb"  style="background-color: white;">
      <div class="col-md-12" style="padding: 10px;">
        <h4 style="margin: 0; padding: 0;">ADMINISTRATOR AREA</h4>
        <span class="breadcrumb-item active">Dashboard</span>
      </div>
      <!-- Breadcrumb Menu-->
    </nav>
  </div>
</section>
<!-- #end breadcrumb -->

<section id="main">
  <div class="container">
    <div class="row">
      <div class="col-md-3" style="margin-bottom: 30px;">
        <div class="list-group">
          <a href="index.php" class="list-group-item active" style="background-color: #484a48; border-color: #484a48"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
          <a href="reservation.php" class="list-group-item "><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Reservation </a>
          <a href="courseOffers.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering</a>
          <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
          <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
          <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
          <a href="accounts.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>

        </div>
      </div>

      <div class="col-md-9">
        <div>
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
                <?php
                $row = reserved();
                echo $row['x'];
                ?>
              </h2>
              <h5>Students Reserved</h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                <?php
                $row = waitlisted();
                echo $row['count'];
                ?>
              </h2>
              <h5>Students on Waitlist</h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                <?php
                $row = courses();
                echo $row['count'];
                ?>
              </h2>
              <h5>Offered Courses</h5>
            </div>
          </div>
          <div class="col-md-3">
            <div class="well dash-box">
              <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 
                <?php
                $row = passers();
                echo $row['count'];
                ?>
              </h2>
              <h5>SASE Passers</h5>
            </div>
          </div>
        </div>

        <!-- <div class="col-md-12"> -->
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Academic Year </h3>
              </div>
              <div class="panel-body">
                <div class="col-md-12" align="right">
                  <button class="btn btn-primary text-white" type="button" data-toggle="modal" data-target="#importmodal" style="background-color: #cc6666; border-color: #ffffff">Import SASE Passers</button>
                  <button class="btn btn-primary text-white" type="button" data-toggle="modal" data-target="#addAy" style="background-color: #cc6666; border-color: #ffffff">Add Academic Year</button>

                </div>
                <div class="container" >
                  <!--title here-->
                  <div class="table-responsive" id="showAY">
                  </div>

                </div>
              </div>
            </div>
          </div>

          <!-- Latest Users -->
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Latest Reservations</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive" id="showRes">
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!--Start Footer -->
  <?php include "includes/footer.php";?>
  <!--End Footer -->

  <!-- Modals -->
  <!-- new ay -->
  <div class="modal" id="addAy" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Academic Year</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form action="" method="post" id="form-acadyear">

            <div class="form-group col-md-12">
              <label for="coursecode">Academic Year</label>
              <input type="text" class="form-control" id="ay" name="ay" readonly />
            </div>

            <div class="form-group col-md-12">
              <hr>
            </div>

            <div class="col-md-12">
              <label>Reservation Date</label>
            </div>

            <div class="form-group col-md-6">
              <label for="coursename">Start</label>
              <input type="date" class="form-control" id="start" name="start" placeholder="May 1, 2019" required />
            </div>

            <div class="form-group col-md-6">
              <label for="coursename">End</label>
              <input type="date" class="form-control" id="end" name="end" placeholder="May 7, 2019" required />
            </div>

            <div class="form-group col-md-12">
              <label for="coursename">Status</label> <span id="confirm-message"></span>
              <select class="form-control" name="status" id="status" onchange="activateWarning();" required>
                <option value="0">inactive</option>
                <option value="1">active</option>
              </select>
            </div>
          </form>
        </div>


        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>

        <div class="modal-footer">
          <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
          <input type="submit" name="insert" id="insert" value="Add" class="btn btn-primary" />
        </div>  
      </div>
    </div>
  </div>



  <!--  -->
  <div class="modal" id="editAY" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Academic Year</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form action="" method="post" id="form-editacadyear">

            <div class="form-group col-md-12">
              <label for="coursecode">Academic Year</label>
              <input type="text" class="form-control" id="eay" name="eay" readonly />
            </div>

            <div class="form-group col-md-12">
              <hr>
            </div>

            <div class="col-md-12">
              <label>Reservation Date</label>
            </div>

            <div class="form-group col-md-6">
              <label for="coursename">Start</label>
              <input type="date" class="form-control" id="estart" name="estart" placeholder="May 1, 2019" required />
            </div>

            <div class="form-group col-md-6">
              <label for="coursename">End</label>
              <input type="date" class="form-control" id="eend" name="eend" placeholder="May 7, 2019" required />
            </div>

            <div class="form-group col-md-12">
              <label for="coursename">Status</label> <span id="confirm-message"></span>
              <select class="form-control" name="estatus" id="estatus" onchange="activateWarning();" required>
                <option value="0">inactive</option>
                <option value="1">active</option>
              </select>
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

  <!-- Import -->
  <div class="modal" id="importmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import CSV File</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form action="" method="post" id="form-import">

            <div class="row">

              <div class="form-group col-md-5">
                <label for="cut-off">Over All Cut-Off</label> 
                <input class="form-control" type="number" name="cutoff" id="cutoff" required>
              </div>

            <div class="form-group col-md-7">
              <label for="exportfile">Import file</label> 
                <input type="file" name="exportfile" id="exportfile" accept=".csv">
            </div>
          </div>

            
            

          </form>
        </div>

        <div class="modal-footer">
          <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
          <button type="submit" id="importfile" name="importfile" class="btn btn-primary">Import</button>
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
      var switchStatus = false;
      $("#customSwitch1").on('change', function() {
        if ($(this).is(':checked')) {
          switchStatus = $(this).is(':checked');
                alert(switchStatus);// To verify
              }
              else {
               switchStatus = $(this).is(':checked');
               alert(switchStatus);// To verify
             }
           });


      showAY();
      showRes();

      function showAY(){
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {action:"vieway"},
          success:function(response){
            $("#showAY").html(response);
            $("#viewaytable").dataTable({
              "searching": false
            });
          }
        });
      }

      function showRes(){
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {action:"viewres"},
          success:function(response){
            $("#showRes").html(response);
            $('#viewres').dataTable({
              "paging":   false,
              "ordering": false,
              "info":     false,
              "searching": false
    
            })
          }
        });
      }


      $('#importfile').on('click', function () {
      var file_data = $('#exportfile').prop('files')[0];
      var form_data = new FormData();
      var cut = $('#cutoff').val();
      form_data.append('file', file_data);
      $.ajax({
        url: 'action.php?cut='+ cut, 
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
          if(response){
            $("#importmodal").modal('hide');
            Swal.fire(
              'Succes!',
              'You have successfully imported a file',
              'success'
              )
          } else {
            Swal.fire(
              'Fail!',
              'There was an error in importing the file',
              'error'
              );
            $("#form-import")[0].reset();
          }     
          
        }
        
      });
    });

      // function confirmImport(){
      //   $.ajax({
      //     url: "action.php",
      //     type: "POST",
      //     data: {action:"viewimport"},
      //     success:function(response){
      //       $("#showAY").html(response);
      //       $("table").dataTable({
      //         "dom": '<"top"l>rt<"bottom"ip><"clear">'
      //       });
      //     }
      //   });
      // }

      getAY();

      function getAY(){
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {action:"getay"},
          success:function(response){
            ind1 = parseInt(response) + 1;
            ind2 = parseInt(response) + 2;
            ind3 = ind1 + '-' + ind2;
            $("#ay").val(ind3);

          }
        });
      }

      
    //insert ajax request
    $("#insert").click(function(e){
      var ay = $("#ay").val();
      var start = $("#start").val();
      var end = $("#end").val();
      var status = $("#status").val();

      if(ay == '' || start == '' || end == '' || status == ''){
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Looks like you missed some fields. Please try again!',
          footer: '<a href>Why do I have this issue?</a>'
        })
      }else{
        if($("#form-acadyear")[0].checkValidity()){
          e.preventDefault();
          $.ajax({
            url: "action.php",
            type: "POST",
            data: $("#form-acadyear").serialize()+"&action=insertay",
            success:function(response){
              data = response;
              if(data = true){
                Swal.fire({
                  title: 'You have successfully added the Academic Year ' + ay,
                  icon: 'success'
                })
                $("#addAy").modal('hide');
                $("#form-acadyear")[0].reset();
                showAY();
                getAY();
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
      $("#eay").val(b[0]);
      $("#estart").val(b[1]);
      $("#eend").val(b[2]);
      if(b[2] == true){
        $("#estatus").val("active");
      } else if(b[2] == false){
        $("#estatus").val("inactive");
      }
      
    })

    //update ajax request
    $("#update").click(function(e){
      var eay = $("#eay").val();
      var estart = $("#estart").val();
      var eend = $("#eend").val();
      var estatus = $("#estatus").val();

      if(eay =='' || estart == '' || eend == '' || estatus == ''){

        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Looks like you missed some fields. Please try again!'
        })
      }else{

        if($("#form-editacadyear")[0].checkValidity()){
          e.preventDefault();
          $.ajax({
            url: "action.php",
            type: "POST",
            data: $("#form-editacadyear").serialize()+"&action=updateay",
            success:function(response){
              Swal.fire({
                title: 'You have successfully updated the Academic Year ' + eay,
                icon: 'success'
              })
              $("#editAY").modal('hide');
              $("#form-editacadyear")[0].reset();
              showAY();
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
      iday = b[0];
      var message = "You are about to delete the Academic Year: <br><h5>" + iday + "</h5>";
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
            data:{iday:iday},
            success:function(response){
              if(response != false){
                tr.css('background-color', '#ff6666');
                Swal.fire(
                  'Deleted!',
                  'You have deleted the Academic Year' + iday,
                  'success'
                  )
                showAY();
                getAY();
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

function activateWarning(){
  var select = document.getElementById('status');
  var message = document.getElementById('confirm-message');
  var bad_color  = "#ff6666";

  if(select.value == "true"){
    message.style.color     = bad_color;
    message.innerHTML       = '<label>you are activating this acad year</label>';
  } else if(select.value == "false"){
    message.innerHTML       = '';
  }
} 
</script>
</body>
</html>
