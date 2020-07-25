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
  <link href="assets/css/styles.css" rel="stylesheet">
  <link href="css/bootstrap.css" rel="stylesheet">
  <!-- <link href="assets/js/bootstrap.js" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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
            <div class="panel panel-default">
              <div class="panel-heading mb-3 col-md-12" style="background-color: #cc6666; border-color: #cc6666">
                <h3 class="panel-title" style="color: white;">College</h3>
              </div>

              <div class="panel-body">
                <div class="row">                   
                  <div class="col-md-12 mn" align="right">
                    <label class="col-md-4 control-label">Choose CSV File</label> 
                    <input  type="file" name="exportfile" id="exportfile" accept=".csv">
                    <button type="submit" id="importfile" name="importfile" class="btn-submit">Import</button>
                    <button class="btn text-white" type="button" data-toggle="modal" data-target="#addCollege" title="Add College" style="background-color: #cc6666; border-color: #ffffff">Add New College</button>
                    <button class="btn text-white" type="button" data-toggle="modal" data-target="#settings" style="background-color: #cc6666; border-color: #ffffff">Settings</button>
                  </div>
                </div>
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
    <div class="modal" id="addCollege" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add New College</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- Modal Body -->
          <div class="modal-body">
            <form action="" method="post" id="form-addcollege">

              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="dcode">College Code</label>
                  <input type="text" class="form-control" id="code" name="code" placeholder="College Code" required />
                </div>

                <div class="form-group col-md-8">
                  <label for="dname">College Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="College Name" required />
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
    <div class="modal" id="editCollege" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
                <h4 class="modal-title">Edit College</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="" method="post" id="form-editcollege">
                        <input type="hidden" name="ocode" id="ocode">

                        <div class="row">
                            <div class="form-group col-sm-4">
                              <label for="edcode">College Code</label>
                              <input type="text" class="form-control" id="ecode" name="ecode" required />
                            </div>

                            <div class="form-group col-md-8">
                              <label for="edname">College Name</label>
                              <input type="text" class="form-control" id="ename" name="ename" required />
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

            <div class="modal" id="settings" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                  <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel">Settings</h3>
                  </div>
                  <div class="modal-body">
                    <form name="myFormer" id="myFormer" method="post">


                      <input type="hidden" name="set_id" id="set_id">

                      <div class="custom-control custom-switch">
                        <label> Allow Chairperson to set Cut-off Scores: </label>
                        <input type="checkbox" id="one" name="one" data-toggle="toggle">
                        
                      </div>
                      <div class="custom-control custom-switch">
                        <label> Bridging: </label>
                        <input type="checkbox" id="two" name="two" data-toggle="toggle">
                        
                      </div>

                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <input class="btn btn-primary" type="submit" id="saving" value="Save" />
                </div>




  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/aaae553ee8.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="DataTables/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="sweetalert2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="script_filterSearch.js"></script>
<script type="text/javascript">
  settings();

  function settings(){
    var setid = "1";
    $.ajax({
      url: "action.php",
      type: "POST",
      data: {setid:setid},
      success:function(response){
        var final = JSON.parse(response);
        console.log(final);
        console.log("final id: " + final.id + ', cpscores: '+ final.cpscores + ', bridging: '+ final.bridging);
        
        $("#set_id").val(final.id);

        if(final.cpscores){
          $('#one').bootstrapToggle('on');
        }else{
          $('#one').bootstrapToggle('off');
        }

        if(final.bridging){
          $('#two').bootstrapToggle('on');
        }else{
          $('#two').bootstrapToggle('off');
        }

      }
    })
  }





  $("#saving").click(function(e){
    if($("#myFormer")[0].checkValidity()){
      console.log("inside validity");
      e.preventDefault();
      $.ajax({
        url: "action.php",
        type: "POST",
            data: $("#myFormer").serialize()+"&action=savesettings",
            success:function(response){
              console.log("inside response");
              if(response = true){
                Swal.fire({
                  title: 'You have updated the settings',
                  icon: 'success'
                })
                settings();
                $("#settings").modal('hide');
                $("#myFormer")[0].reset();
                
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops!',
                  text: "You're entering a duplicate!"
                });
                $("#myFormer")[0].reset();
              }
            }

            
        })
 }
      
    })


  $(document).ready(function(){
    showCollege();

    function showCollege(){
      $.ajax({
        url: "action.php",
        type: "POST",
        data: {action:"viewcollege"},
        success:function(response){
          $("#showUser").html(response);
          $("table").dataTable({
            "dom": '<"top"l>rt<"bottom"ip><"clear">'
          });
        }
      });
    }

    $('#importfile').on('click', function () {
      var file_data = $('#exportfile').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
        url: 'action.php', // point to server-side PHP script 
        dataType: 'text', // what to expect back from the PHP script
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
          console.log(response);
          showCollege();
          Swal.fire(
            'Succes!',
            'You have successfully imported a file',
            'success'
            )
          
        }
      });
    });

  //insert ajax request
    $("#insert").click(function(e){
      var code = $("#code").val();
      var name = $("#name").val();

      if(code == '' || name == ''){
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Looks like you missed some fields. Please try again!',
          footer: '<a href>Why do I have this issue?</a>'
        })
      }else{
        if($("#form-addcollege")[0].checkValidity()){
          e.preventDefault();
          $.ajax({
            url: "action.php",
            type: "POST",
            data: $("#form-addcollege").serialize()+"&action=insertcollege",
            success:function(response){
              data = response;
              console.log(data);
              if(data = "tama"){
                Swal.fire({
                  title: 'You have successfully added the ' + name + ' department',
                  icon: 'success'
                })
                $("#addCollege").modal('hide');
                $("#form-addcollege")[0].reset();
                showCollege();
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops!',
                  text: "You're entering a duplicate!"
                });
                $("#form-addcollege")[0].reset();
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
      console.log(b[0]);
      $("#ocode").val(b[0]);
      $("#ecode").val(b[0]);
      $("#ename").val(b[1]);
    })

    //update ajax request
    $("#update").click(function(e){
      var ocode = $("#ocode").val();
      var ecode = $("#ecode").val();
      var ename = $("#ename").val();

      if(ocode =='' || ecode == '' || ename == ''){
        Swal.fire({
          icon: 'error',
          title: 'Oops!',
          text: 'Looks like you missed some fields. Please try again!'
        })
      }else{

        if($("#form-editcollege")[0].checkValidity()){
          e.preventDefault();
          $.ajax({
            url: "action.php",
            type: "POST",
            data: $("#form-editcollege").serialize()+"&action=updatecollege",
            success:function(response){
              //data = response;
              console.log(response);
              //if(data = true){
              Swal.fire({
                title: 'You have successfully updated the ' + ename + ' department',
                icon: 'success'
              })
              $("#editCollege").modal('hide');
              $("#form-editcollege")[0].reset();
              showCollege();
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
      idcc = b[0];
      var message = "You are about to delete the department: <br><h5>" +b[1] + "</h5>";
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
            data:{idcc:idcc},
            success:function(response){
              console.log(response);
              if(response != false){
                tr.css('background-color', '#ff6666');
                Swal.fire(
                  'Deleted!',
                  'You have deleted the ' + b[1] + ' department',
                  'success'
                  )
                showCollege();
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
