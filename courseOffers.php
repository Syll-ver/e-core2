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
                  <button type="button" class="btn btn-primary m-1 float-right scoBtn" data-toggle="modal" data-target="#offercourse" style="background-color: #cc6666; border-color: #ffffff">Offer Course</button>
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

      <!-- OFFER COURSE -->
      <div class="modal" id="offercourse" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Offer Course</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
              <form action="" method="post" id="form-offercourse">
                <div class="table-responsive" id="offerThese">
                </div>
              </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
              <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
              <input type="submit" name="offer" id="offer" value="Add" class="btn btn-primary" />
            </div>  

          </div>
        </div>
      </div>

      <!--SET CUT OFF-->
      <div class="modal" id="setcutoffModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Offered Course</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
              <form action="" method="post" id="form-setcutoff">

                <input type="hidden" class="form-control" id="code" name="code" readonly/>

                <div class="form-group col-md-12">
                  <label for="coursename">Course Name  </label>
                  <input type="text" class="form-control" id="coursename" name="coursename" readonly/>
                </div>

                <div class="form-group col-md-4">
                  <label for="cutOff1">Course Cut-Off </label>
                  <input type="text" class="form-control" id="cutOff" name="cutOff" placeholder="00" required/>
                </div>

                <div class="form-group col-md-4">
                  <label for="cutOff2">Aptitude</label>
                  <input type="text" class="form-control" id="cutOff_AP" name="cutOff_AP" placeholder="00" />
                </div>

                <div class="form-group col-md-4">
                  <label for="cutOff3">Language</label>
                  <input type="text" class="form-control" id="cutOff_LU" name="cutOff_LU" placeholder="00" />
                </div>

                <div class="form-group col-md-4">
                  <label for="cutOff4">Mathematics</label>
                  <input type="text" class="form-control" id="cutOff_MA" name="cutOff_MA" placeholder="00" />
                </div>

                <div class="form-group col-md-4">
                  <label for="cutOff5">Science</label>
                  <input type="text" class="form-control" id="cutOff_SC" name="cutOff_SC" placeholder="00" />
                </div>

                <div class="form-group col-md-4">
                  <label for="slot">Slots</label>
                  <input type="text" class="form-control" id="slot" name="slot" placeholder="00" />
                </div>

              </form>
            </div>

            <div class="form-group modal-footer">
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
      showCourseOffer();
      toOffer();

      function showCourseOffer(){
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {action:"viewcourseoffer"},
          success:function(response){
              //console.log(response);
              $("#showTable").html(response);
              $("table").dataTable({
                "dom": '<"top"l>rt<"bottom"ip><"clear">'

              });
            }
          });
      }

      function toOffer(){
        $.ajax({
          url: "action.php",
          type: "POST",
          data: {action:"courses"},
          success:function(response){
            $("#offerThese").html(response);
          }
        });
      }

      //insert ajax request
      $("#offer").click(function(e){
        if($("#form-offercourse").serialize() != ''){
          if($("#form-offercourse")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
              url: "action.php",
              type: "POST",
              data: $("#form-offercourse").serialize()+"&action=offercourse",
              success:function(response){
                data = response;
                if(data = true){
                  Swal.fire({
                    title: 'You have successfully offered the following courses',
                    icon: 'success'
                  })
                  showCourseOffer();
                  toOffer();
                  $("#offercourse").modal('hide');
                  $("#form-offercourse")[0].reset();
                } else if(data = false){
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: "You're entering a duplicate!"
                  });
                  $("#form-offercourse")[0].reset();
                }    
              }
            });
          };
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'You did not choose a course. Please try again!',
            footer: '<a href>Why do I have this issue?</a>'
          })

        }
      });

      $("body").on("click", ".editBtn", function(e){
        e.preventDefault();
        var edit_id = $(this).attr('id');
        a = decodeURIComponent(edit_id);
        b = a.split("=");
        console.log(b);
        $("#code").val(b[1]);
        $("#coursename").val(b[2]);
        $("#cutOff").val(b[6]);
        $("#cutOff_AP").val(b[7]);
        $("#cutOff_LU").val(b[8]);
        $("#cutOff_MA").val(b[9]);
        $("#cutOff_SC").val(b[10]);
        $("#slot").val(b[11]);
      });


      //update ajax request
      $("#update").click(function(e){
        var code = $("#code").val();
        var coursename = $("#coursename").val();
        var cutOff = $("#cutOff").val();
        var cutOff_AP = $("#cutOff_AP").val();
        var cutOff_LU = $("#cutOff_LU").val();
        var cutOff_MA = $("#cutOff_MA").val();
        var cutOff_SC = $("#cutOff_SC").val();
        var slot = $("#slot").val();

        if(code =='' || coursename =='' || cutOff == '' || cutOff_AP == '' || cutOff_LU == ''|| cutOff_MA == ''|| cutOff_SC == ''|| slot == ''){
          Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Looks like you missed some fields. Please try again!'
          })
        }else{
          if($("#form-setcutoff").serialize()!= ''){
            if($("#form-setcutoff")[0].checkValidity()){
            e.preventDefault();
            $.ajax({
              url: "action.php",
              type: "POST",
              data: $("#form-setcutoff").serialize()+"&action=setcutoff",
              success:function(response){
                data = response;
                if(response = true){
                  Swal.fire({
                    title: 'You have successfully updated the offered course ' + coursename,
                    icon: 'success'
                  })
                  showCourseOffer();
                  $("#setcutoffModal").modal('hide');
                  $("#form-setcutoff")[0].reset();
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: 'Change is not implemented'
                  })
                  $("#form-setcutoff")[0].reset();
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
        idco = b[1];
        var message = "You are about to remove <br><h5>" + b[2] + "<br></h5> from " + b[0] + " Course Offering";
        Swal.fire({
          title: 'Are you sure?',
          html: message,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, remove it!',
          cancelButtonText: 'No, keep it'
        }).then((result) => {
          if(result.value){
            console.log(id);
            $.ajax({
              url:"action.php",
              type:"POST",
              data:{idco:idco},
              success:function(response){
                console.log(response);
                if(response = true){
                  tr.css('background-color', '#ff6666');
                  Swal.fire(
                    'Deleted!',
                    'You have removed <br><h5>' + b[2] + '<br></h5> from ' + b[0] + ' Course Offering',
                    'success'
                    )
                  showCourseOffer();
                  toOffer();
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

  function toggle(source) {
    checkboxes = document.getElementsByName('check_list[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }

</script>
  </body>
  </html>
