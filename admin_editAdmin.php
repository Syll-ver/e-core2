<?php
  include('config/config.php');

  $input = urldecode($_GET['id']);
  $ari = parse_url(urldecode($input));
  $from_arr = implode(' ', $ari);
  $to_arr = explode('&', $from_arr);

  // $id=urldecode($_GET['id']);
  // $result = $pdo->prepare('SELECT *
  //                           FROM accounts
  //                           WHERE "id" = :id');
  // $result->bindParam(':id', $id);
  // $result->execute();
  //     for($i=0; $rows = $result->fetch(); $i++){  
  
$result1 = $pdo->prepare("SELECT * FROM chairperson
                              JOIN department USING (\"deptCode\")
                              WHERE username = '".substr(urldecode($to_arr[3]), 2)."'");
        $result1->execute();
        $rows1 = $result1->fetch();

        $result = $pdo->prepare('SELECT * FROM department
                              WHERE "deptCode"
                              NOT IN (SELECT "deptCode"
                              FROM department
                              JOIN chairperson USING ("deptCode"))');
        $result->execute();
  

?>

<div class="modal-header">
  <h4 class="modal-title" id="exampleModalLabel">Edit Admin Account</h4>
</div>
<div class="modal-body">

  <?php
    for($i = 0; $i < count($to_arr); $i++){
      echo $i.": ".urldecode($to_arr[$i])."<br />";
    }
  ?>


  <form name="dept" method="post" action="includeThis/admin_edit.php">

    <input type="hidden" name="id" id="id" value="<?php echo substr(urldecode($to_arr[1]), 2); ?>" />

    <div class="form-group col-md-6">
      <label for="adminuser">Username  </label>
      <input type="text" class="form-control" id="adminName" name="adminName" value="<?php echo substr(urldecode($to_arr[3]), 2); ?>" required />
    </div>
    
    <div class="form-group col-md-6">
      <label for="roleselect">Role  </label>
      <select class="form-control" name="roleselect" onchange="showDiv('hiddenChair', this);" id="role" required>
        <?php 
        
        echo "<option value='".substr(urldecode($to_arr[5]), 2)."'>".substr(urldecode($to_arr[5]), 2)."</option>";
        if(substr(urldecode($to_arr[5]), 2) == "admin"){
          $a = 'display: none;';
          echo "<option value='chairperson'>chairperson</option>";
        } else if(substr(urldecode($to_arr[5]), 2) == "chairperson"){
          $a = 'display: block;';
          echo "<option value='admin'>admin</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group col-md-12" id="hiddenDiv" style="<?php echo $a ?>">
      <label for="dept">Department</label>
      <?php echo $rows1['deptCode']."<br />"; ?>
      <select class="form-control" name="dept" required="required" id="dept">
        <?php
        
        //$row = $result->fetch();
        
          for($i = 0; $row = $result->fetch(); $i++){
            if($row['deptCode'] == $rows1['deptCode']){
              echo '<option value="'.$row['deptCode'].'" selected="selected">'.$row['deptName'].'</option>';
            } else {
              echo '<option value="'.$row['deptCode'].'">'.$row['deptName'].'</option>';
            }
          }
        ?>
      </select> 
    </div> 

    <div class="form-group col-md-12" id="hiddenChair" style="display: none;">
      <label for="dept">Department</label>
      <?php echo "hello dito"; ?>
      <select class="form-control" name="dept" required="required" id="dept">
        <?php
        echo '<option value="">Select Department</option>';
          $result->execute();
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
<script>
  function showDiv(divId, element){
    document.getElementById(divId).style.display = element.value == 'chairperson' ? 'block' : 'none';
  }

  if(document.getElementById('role').value == 'chairperson'){

  }
  
</script>
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
