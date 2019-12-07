<?php
include('config/config.php');

$input = urldecode($_GET['oldcode']);
$ari = parse_url(urldecode($input));
$from_arr = implode(' ', $ari);
$to_arr = explode('&', $from_arr);

$result1 = $pdo->prepare('SELECT "deptCode", "deptName"
                                  FROM department');
$result1->execute();

?>

<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Edit Course</h3>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">

  <?php
    for($i = 0; $i < count($to_arr); $i++){
      echo urldecode($to_arr[$i])."<br />";
    }
  ?>

    <form name="dept" method="post" action="includeThis/course_edit.php">

    <input type="hidden" name="oldcode" id="oldcode" value="<?php echo substr(urldecode($to_arr[0]), 11); ?>" />

    <div class="form-group col-md-3">
      <label for="coursecode">Course Code  </label>
      <input type="text" class="form-control" id="coursecode" name="coursecode" value="<?php echo substr(urldecode($to_arr[0]), 11); ?>"  />
    </div>

    <div class="form-group col-md-5">
      <label for="coursename">Course Name  </label>
      <input type="text" class="form-control" id="coursename" name="coursename" value="<?php echo substr(urldecode($to_arr[2]), 11); ?>" />
    </div>

    <div class="form-group col-md-4">
      <label for="track">Strand</label>
      <input type="text" class="form-control" id="strand" name="strand" value="<?php echo substr(urldecode($to_arr[4]), 7); ?>" />
    </div>

    <div class="form-group col-md-12" id="dept2">
      <label for="Department">Department  </label>
      <select class="form-control" name="dept" id="dept">
        <?php 
        
        for($i=0; $rowsss = $result1->fetch(); $i++){
          if(substr(urldecode($to_arr[6]), 9) == $rowsss['deptCode']){
            echo '<option value="'.$rowsss['deptCode'].'" selected="selected">'.$rowsss['deptName'].'</option>';
          } else {
            echo '<option value="'.$rowsss['deptCode'].'">'.$rowsss['deptName'].'</option>';
          }    
        }
        
        // for($i=0; $rowsss = $result1->fetch(); $i++){
        //   if(substr(urldecode($to_arr[6]), 9) !== $rowsss['deptCode']){
        //   echo '<option value="'.$rowsss['deptCode'].'">'.$rowsss['deptName'].'</option>';
        // }
        // }
          
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


