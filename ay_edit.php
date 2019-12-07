<?php
  include('config/config.php');

 
$input = urldecode($_GET['id']);
$ari = parse_url(urldecode($input));
$from_arr = implode(' ', $ari);
$to_arr = explode('&', $from_arr);

 
?>

<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Edit Academic Year</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body"> 
 <?php
//  for($i=0; $i < count($to_arr); $i++){
//     echo urldecode($to_arr[$i]."<br  />");
//  }
  ?> 
  <form role="form" name="adday" id="adday" autocomplete="off" method="post" action="includeThis/ay_edit.php">
    <input type="hidden" name="oldacad" value="<?php echo substr(urldecode($to_arr[0]), 9)?>">

        <div class="form-group col-md-12">
          <label for="ay">Academic Year</label>
          <input type="text" class="form-control" id="ay" name="ay" value="<?php echo substr(urldecode($to_arr[0]), 9)?>" required />
        </div>

        <div class="col-md-12">
          <label>Reservation Date</label>
        </div>

        <div class="form-group col-md-6">
          <label for="start">Start</label>
          <input type="date" class="form-control" id="start" name="start" value="<?php echo substr(urldecode($to_arr[2]), 17)?>" required />
        </div>

        <div class="form-group col-md-6">
          <label for="end">End</label>
          <input type="date" class="form-control" id="end" name="end" value="<?php echo substr(urldecode($to_arr[4]), 15)?>" required />
        </div>

        <div class="form-group col-md-12">
          <label for="coursename">Status</label> <span id="confirm-message"></span>
          <select class="form-control" name="status" id="status" onchange="activateWarning();" required>
            <?php
            $stats = substr(urldecode($to_arr[6]), 7);
             if( $stats == 1){
               echo "<option value='".$stats."'>active</option>";
               echo "<option value='false'>inactive</option>";
             } else if($stats == 0){
               echo "<option value='".$stats."'>inactive</option>";
               echo "<option value='true'>active</option>";
             }
            ?>
          </select>
        </div> 

 <div class="modal-footer">
  <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
  <input class="btn btn-primary" type="submit" value="Update" />
</div>  

  </form>
   
</div>



<script>
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

<!-- CONTENT-WRAPPER SECTION END-->
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
