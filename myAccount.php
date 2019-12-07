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
$myAccount = myAdminAccount($user);

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
    <title>My Account</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="assets/js/bootstrap.js" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <style>

    .form-control {
        min-height: 41px;
    background: #fff;
    box-shadow: none !important;
  }
  .form-control:focus {
    border-color: #70c5c0;
  }
    .form-control, .btn {        
        border-radius: 2px;
    }
  .account-form {
    width: 350px;
    margin: 0 auto;
    padding: 100px 0 30px;    
  }
  .account-form form {
    color: #7a7a7a;
    border-radius: 2px;
      margin-bottom: 15px;
        font-size: 13px;
        background: #ffffff;
        padding: 30px;  
        position: relative; 
    }
  .account-form h2 {
    font-size: 22px;
        margin: 35px 0 25px;
    }
  .account-form .avatar {
    position: absolute;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: -50px;
    width: 95px;
    height: 95px;
    border-radius: 50%;
    z-index: 9;
    background: #cc6666;
    padding: 15px;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
  }
  .account-form .avatar img {
    width: 100%;
  } 
    .account-form input[type="checkbox"] {
        margin-top: 2px;
    }
    .account-form .btn {        
        font-size: 16px;
        font-weight: bold;
    background: #cc6666;
    border: none;
    margin-bottom: 20px;
    }
  .account-form .btn:hover, .account-form .btn:focus {
    background: #cc6666;
        outline: none !important;
  }    
  .account-form a {
    color: #fff;
    text-decoration: underline;
  }
  .account-form a:hover {
    text-decoration: none;
  }
  .account-form form a {
    color: #7a7a7a;
    text-decoration: none;
  }
  .account-form form a:hover {
    text-decoration: underline;
  }
  </style>
  <body>

    <!--navbar-->
    <?php include "includes/navbar.php";?>
    <!--#end navbar-->

    <section id="breadcrumb">
      <div class="container">
        <nav class="breadcrumb"  style="background-color: white;">
          <div class="col-md-12" style="padding: 10px;">
            <h4 style="margin: 0; padding: 0;">ADMINISTARTOR AREA</h4>
            <span class="breadcrumb-item active">My Account</span>
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
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span> Course Offering </a>
              <a href="course.php" class="list-group-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Courses</a>
              <a href="department.php" class="list-group-item"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Department </a>
              <a href="college.php" class="list-group-item"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> College </a>
              <a href="accounts.php" class="list-group-item "><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts </a>
              <!-- <a href="notification.php" class="list-group-item"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span> Notification </a> -->
            </div>
            
          </div>



          <div class="col-md-9">
            <!--Academic Year Setting-->
            <div class="panel panel-default">
              <div class="panel-heading" style="margin-bottom: 1%; background-color: #cc6666;">
                <h3 class="panel-title" style="margin-top: 1%; color: white;">My Account</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-12">

                  <form action="includeThis/account_edit.php" method="post">
                    <div class="account-form">
                      <div class="avatar" style="margin-top: 10%;">
                      <img src="includes/account.png" alt="Avatar" style="height: 65px; width: 65px;">
                    </div>
                    <h2 class="text-center">My Account</h2>   
                    </div>

                    <input type="hidden" name="id" value="<?php echo $myAccount['id']; ?>">

                    <div class="form-group col-sm-6">
                      <label for="adminName">Name  </label>
                      <input type="text" class="form-control" id="adminName" name="adminName" value="<?php echo $myAccount['name'] ?>" required />
                    </div>

                    <div class="form-group col-md-6">
                      <label for="email">Email  </label>
                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $myAccount['email'] ?>" required />
                    </div>  
                        
                    <div class="form-group col-md-6">
                      <label for="adminuser">Username  </label>
                      <input type="text" class="form-control" id="adminUser" name="adminUser" value="<?php echo $myAccount['username'] ?>" required />
                    </div>

                    <div class="form-group col-md-6">
                      <label for="role">Role  </label>
                      <select name="role" class="form-control">
                        <option value="<?php echo $myAccount['role']; ?>"><?php echo $myAccount['role']; ?></option>
                        <?php
                        if($myAccount['role'] == 'admin'){
                          echo '<option value="chairperson">chairperson</option>"';
                        } else if($myAccount['role'] == 'chairperson'){
                          echo '<option value="admin">admin</option>"';
                        }
                        ?>
                      </select>
                    </div>  

                    <div class="form-group col-md-6">
                      <label for="password">Password  </label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" onkeyup="checkPass();" required />
                    </div> 

                    <div class="form-group col-md-6">
                      <label for="confpassword">Re-enter Password  </label> <span id="confirm-message"></span>
                      <input type="password" class="form-control" id="confpassword" name="confpassword" placeholder="Enter Password" onkeyup="checkPass();" required />
                    </div> 

                    <div class="account-form">
                      <button type="submit" class="btn btn-primary btn-sm btn-block">Edit Account</button>
                    </div>
                  </form>
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


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="script_filterSearch.js"></script>
    </body>
</html>
    <script type="text/javascript">
      function checkPass()
      {
          //Store the password field objects into variables ...
          var password = document.getElementById('password');
          var confirm  = document.getElementById('confpassword');
          //Store the Confirmation Message Object ...
          var message = document.getElementById('confirm-message');
          //Set the colors we will be using ...
          var good_color = "#66cc66";
          var bad_color  = "#ff6666";
          //Compare the values in the password field 
          //and the confirmation field
          if((password.value == confirm.value) && (password.value != "") && (confirm.value != "")){
              //The passwords match. 
              //Set the color to the good color and inform
              //the user that they have entered the correct password 
              confirm.style.backgroundColor = good_color;
              message.style.color           = good_color;
              message.innerHTML             = '<span class="glyphicon glyphicon-ok"> </span><label> Passwords Match!</label>'; //'<img src="/wp-content/uploads/2019/04/tick.png" alt="Passwords Match!">';
          } else if(password.value != confirm.value){
              //The passwords do not match.
              //Set the color to the bad color and
              //notify the user.
              confirm.style.backgroundColor = bad_color;
              message.style.color           = bad_color;
              message.innerHTML             = '<span class="glyphicon glyphicon-remove"> </span><label> Passwords Do Not Match!</label>'; //'<img src="/wp-content/uploads/2019/04/publish_x.png" alt="Passwords Do Not Match!">';
          } else{
            confirm.style.backgroundColor   = "#ffffff";
              message.innerHTML             = "";
              
          }
      }  
</script>
  </body>
</html>
