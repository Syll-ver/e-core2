<?php
  include('config/config.php');

  $input = urldecode($_GET['code']);
  $ari = parse_url(urldecode($input));
  $from_arr = implode(' ', $ari);
  $to_arr = explode('&', $from_arr);

  // $oldcode=urldecode($_GET['olddcode']);
  // $result = $pdo->prepare('SELECT "collegeCode", "deptCode", "deptName", "collegeName"
  //                           FROM department
  //                           JOIN college USING("collegeCode")
  //                           WHERE ("deptCode") = :code ');
  // $result->bindParam(':code', $oldcode);
  // $result->execute();
  // for($i=0; $rows = $result->fetch(); $i++){
?>

<div class="modal-header">
  <h4 class="modal-title" id="exampleModalLabel">Edit Department</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body">

  <?php
    for($i = 0; $i < count($to_arr); $i++){
      echo $i.": ".urldecode($to_arr[$i])."<br />";
    }
  ?>
  <form name="dept" id="dept" method="post" action="includeThis/college_d_edit.php">

    <input type="hidden" name="oldcode" value="<?php echo substr(urldecode($to_arr[1]), 2); ?>" />

    <div class="form-group col-md-12">
      <label for="College" >College  </label>
      <select class="form-control" name="college" id="college">
        <?php
          $result1 = $pdo->prepare('SELECT *
                                      FROM college
                                      ');
          $result1->execute();
          for($i=0; $row = $result1->fetch(); $i++){
            if(substr(urldecode($to_arr[3]), 2) == $row['collegeCode']){
              echo '<option value="'.$row['collegeCode'].'" selected="selected">'.$row['collegeName'].'</option>';
            } else {
              echo '<option value="'.$row['collegeCode'].'">'.$row['collegeName'].'</option>';
            }
          }
        ?> 
      </select> 
    </div> 

    <div class="form-group col-md-4">
      <label for="coursecode">Department Code</label>
      <input type="text" class="form-control" id="deptcode" name="deptcode" value="<?php echo substr(urldecode($to_arr[1]), 2); ?>" />
    </div>

    <div class="form-group col-md-8">
      <label for="coursename">Department Name</label>
      <input type="text" class="form-control" id="deptname" name="deptname" value="<?php echo substr(urldecode($to_arr[5]), 2); ?>" />
    </div>

    <div class="modal-footer col-md-12">
      <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />  
      <input type="submit" class="btn btn-primary" value="Update" />
    </div>

  </form>

</div>



<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
