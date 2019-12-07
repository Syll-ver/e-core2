<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Add New Account</h3>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <form name="dept" method="post" action="includeThis/admin_add.php">
    
    <div class="form-group col-md-6">
      <label for="adminuser">Name  </label>
      <input type="text" class="form-control" id="adminName" name="adminName" placeholder="Enter Name" required />
    </div>
    
    <div class="form-group col-md-6">
      <label for="adminuser">Username  </label>
      <input type="text" class="form-control" id="adminUser" name="adminUser" placeholder="Enter Username" required />
    </div>

    <div class="form-group col-md-6">
      <label for="password">Password  </label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required /> <!--onkeyup="checkPass();" required /> -->
    </div>  
    <!--
    <div class="form-group col-md-6">
      <label for="confpassword">Confirm Password</label>
      <input type="password" class="form-control" id="confpassword" name="confpassword" placeholder="Retype Password" onkeyup="checkPass();" required />
      <span id="confirm-message"></span> 
    </div> 
  -->

    <div class="form-group col-md-6">
      <label for="role">Role</label>
      <select class="form-control" name="role" required="required" id="role" onchange="showDiv('hiddenChair', this)">
        <option value="admin">admin</option>
        <option value="chairperson">chairperson</option>
      </select> 
    </div> 

    <div class="form-group col-md-12" id="hiddenChair" style="display: none;">
      <label for="dept">Department</label>
      <select class="form-control" name="dept" required="required" id="dept">
        <?php
        include('config/config.php');   
          $result = $pdo->prepare('SELECT * FROM department
                                            WHERE "deptCode"
                                            NOT IN (SELECT "deptCode"
                                                FROM department
                                                JOIN chairperson using ("deptCode"))');
          $result->execute();
          echo '<option>Select Department</option>';
          for($i=0; $row = $result->fetch(); $i++){
          echo '<option value="'.$row['deptCode'].'">'.$row['deptName'].'</option>';
          }
        ?>
      </select> 
    </div> 

    <div class="modal-footer col-md-12">
      <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />  
      <input type="submit" class="btn btn-primary" value="Add" />
    </div>

  </form>
</div>


<!-- CONTENT-WRAPPER SECTION END-->
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">

  function showDiv(divId, element){
    document.getElementById(divId).style.display = element.value == 'chairperson' ? 'block' : 'none';
  }

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